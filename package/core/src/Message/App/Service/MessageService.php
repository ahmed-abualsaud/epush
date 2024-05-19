<?php

namespace Epush\Core\Message\App\Service;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

use Epush\Shared\Infra\Utils\Settings;
use Epush\Shared\Infra\Utils\WalletActions;

use Epush\Core\Sender\App\Contract\SenderServiceContract;
use Epush\Core\Message\Infra\Driver\MessageDriverContract;
use Epush\Core\Message\App\Contract\MessageServiceContract;
use Epush\Core\IPWhitelist\App\Contract\IPWhitelistServiceContract;
use Epush\Core\Message\App\Contract\MessageDatabaseServiceContract;

use Epush\Core\MessageGroup\App\Contract\MessageGroupServiceContract;
use Epush\Core\MessageFilter\App\Contract\MessageFilterServiceContract;
use Epush\Core\MessageSegment\App\Contract\MessageSegmentServiceContract;
use Epush\Core\MessageLanguage\App\Contract\MessageLanguageServiceContract;
use Epush\Core\MessageRecipient\App\Contract\MessageRecipientServiceContract;
use Epush\Core\SenderConnection\App\Contract\SenderConnectionServiceContract;
use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientServiceContract;

use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class MessageService implements MessageServiceContract
{
    public function __construct(

        private SenderServiceContract $senderService,
        private MessageDriverContract $messageDriver,
        private IPWhitelistServiceContract $ipWhitelistService,
        private MessageGroupServiceContract $messageGroupService,
        private MessageFilterServiceContract $messageFilterService,
        private MessageSegmentServiceContract $messageSegmentService,
        private MessageLanguageServiceContract $messageLanguageService,
        private MessageDatabaseServiceContract $messageDatabaseService,
        private MessageRecipientServiceContract $messageRecipientService,
        private SenderConnectionServiceContract $senderConnectionService,
        private InterprocessCommunicationEngineContract $communicationEngine,
        private MessageGroupRecipientServiceContract $messageGroupRecipientService

    ) {}


    public function list(int $take): array
    {
        $messages = $this->messageDatabaseService->paginateMessages($take);

        $ordersID = array_unique(array_column($messages['data'], 'order_id'));
        $orders = $this->communicationEngine->broadcast("expense:order:get-orders-by-id", $ordersID, 1000000000000)[0];
        $messages['data'] = tableWith($messages['data'], $orders['data'], "order_id");

        $sendersID = array_unique(array_column($messages['data'], 'sender_id'));
        $senders = $this->senderService->getSendersByID($sendersID);
        $messages['data'] = tableWith($messages['data'], $senders, "sender_id");

        return $messages;
    }

    public function get(string $messageID): array
    {
        $message = $this->messageDatabaseService->getMessage($messageID);

        $ordersID = array_unique(array_column([$message], 'order_id'));
        $orders = $this->communicationEngine->broadcast("expense:order:get-orders-by-id", $ordersID, 1000000000000)[0];
        $message = tableWith([$message], $orders['data'], "order_id");

        $sendersID = array_unique(array_column($message, 'sender_id'));
        $senders = $this->senderService->getSendersByID($sendersID);
        $message = tableWith($message, $senders, "sender_id");

        return $message[0];
    }

    public function getMessageRecipients(string $messageID, int $take = 10): array
    {
        return $this->messageGroupRecipientService->getMessageRecipients($messageID, $take);
    }

    public function getMessagesByUsersID(array $usersID, int $take = 10): array
    {
        return $this->messageDatabaseService->getMessagesByUsersID($usersID, $take);
    }

    public function getMessagesByOrdersID(array $ordersID, int $take = 10): array
    {
        return $this->messageDatabaseService->getMessagesByOrdersID($ordersID, $take);
    }

    public function getMessagesBySendersID(array $sendersID, int $take = 10): array
    {
        return $this->messageDatabaseService->getMessagesBySendersID($sendersID, $take);
    }

    public function add(string $userID, array $message, array $messageGroupRecipients, array $segments): array
    {
        $sender = $this->senderService->get($message['sender_id']);
        if (empty($sender)) {
            return exceptionObject(400, "Invalid Sender");
        }

        if (! $sender['approved']) {
            return exceptionObject(400, "Sender is not approved");
        }

        $senderConnections = $this->senderConnectionService->getSenderConnections($message['sender_id']);
        if (empty($senderConnections)) {
            return exceptionObject(400, "Sender is not activated towards any network");
        }

        $numbers = array_reduce($messageGroupRecipients, function ($carry, $messageGroupRecipient) {
            $recipients = array_map(fn($recip) => $recip['number'], $messageGroupRecipient['recipients']);
            return array_merge($carry, $recipients);
        }, []);

        $adjustedSenderConnections = $this->clusterPhoneNumbersRegardingSenderConnections($senderConnections, $numbers);
        if (empty($adjustedSenderConnections['valid_numbers'])) {
            return exceptionObject(400, "No valid numbers found");
        }

        foreach ($adjustedSenderConnections['connections'] as $conn) {
            if (! $conn['approved'] && ! empty($conn['numbers'])) {
                return exceptionObject(400, "Sender is not activated towards ".$conn['smsc']['country']['name'].', '.$conn['smsc']['operator']['name']);
            }
        }

        $wordFilterThreshold = castSettings($this->communicationEngine->broadcast("settings:get", Settings::WORD_FILTER_THRESHOLD->value)[0]);
        $censoredWords = array_map(fn ($word) => $word['name'], $this->messageFilterService->list(1000000000000)['data']);
        $result = findSimilarWords($message['content'], $censoredWords, $wordFilterThreshold);
        if (! empty($result)) {
            return exceptionObject(400, "The word: ".$result[0]['text_word']." Is matching the censored word: ".$result[0]['blacklisted_word']." Therefore, we recommend changing it");
        }

        $language = $this->messageLanguageService->get($message['message_language_id']);
        if (! empty(array_diff(str_split($message['content']), str_split($language['characters']." \b\t\r\n")))) {
            return exceptionObject(400, "Invalid message langauage");
        }

        $maxNumOfSegments = castSettings($this->communicationEngine->broadcast("settings:get", Settings::MAXIMUM_NUMBER_OF_MESSAGES_SEGMENTS->value)[0]);
        if ($maxNumOfSegments < $message['number_of_segments']) {
            return exceptionObject(400, "Maximum number of segments exceeded");
        }

        $lastOrder = $this->communicationEngine->broadcast("expense:order:get-client-latest-order", $userID)[0];
        if (empty($lastOrder)) {
            return exceptionObject(400, "You didn't make any order, please make an order to charge your account");
        }

        if (! array_key_exists('pricelist', $lastOrder) || empty($lastOrder['pricelist']) ||
            ! array_key_exists('price', $lastOrder['pricelist']) || empty($lastOrder['pricelist']['price'])) {
                return exceptionObject(400, "Invalid price list");
        }

        $message['single_message_cost'] = $lastOrder['pricelist']['price'];
        $totalCost = (float) number_format($message['single_message_cost'] * $message['number_of_segments'] * $message['number_of_recipients'], 2, '.', '');
        $message['total_cost'] = $totalCost;

        $this->communicationEngine->broadcast(
            "core:client:update-client-wallet", 
            $userID, 
            $totalCost, 
            WalletActions::DEDUCT->value
        );

        $approved = false;
        $messageApprovmentLimit = castSettings($this->communicationEngine->broadcast("settings:get", Settings::MESSAGE_APPROVEMENT_LIMIT->value)[0]);
        $numberOfRecipients = $this->getTotalNumberOfRecipients($messageGroupRecipients);
        if ($numberOfRecipients < $messageApprovmentLimit) {
            $approved = true;
            $message['approved'] = $approved;
            $message['sent'] = ! $approved || (array_key_exists('scheduled_at', $message) && Carbon::parse($message['scheduled_at'])->gte(Carbon::now())) ? false : true;
        }

        if ($approved) {
            // send the message
            foreach ($adjustedSenderConnections['connections'] as $conn) {
                $this->messageDriver->sendMessage($sender['name'], $conn['smsc']['smsc']['value'], $message['content'], $conn['numbers'], $language['name']);
            }
        } else {
            $this->notifyMessageApproval();
        }

        $message['message_type'] = $this->isTheAuthenticatedUserAdmin() ? 'Admin' : 'Client';
        $message = $this->messageDatabaseService->addMessage($message);
        $this->messageSegmentService->add($message['id'], $segments);

        // $status = array_key_exists('scheduled_at', $message) && Carbon::parse($message['scheduled_at'])->gte(Carbon::now()) ? 'Scheduled' : 'Sent';

        // foreach ($messageGroupRecipients as $messageGroupRecipient) {
        //     $msgrcp = $this->messageGroupService->add([
        //         'name' => $messageGroupRecipient['name'],
        //         'user_id' => $messageGroupRecipient['user_id']
        //     ], $messageGroupRecipient['recipients']);
        //     $this->messageRecipientService->add($message['id'], array_column($msgrcp, 'id'), $status);
        // }

        $this->messageDriver->insertMessage($message, $messageGroupRecipients);

        return $this->get($message['id']);
    }






    public function bulkAdd(string $userID, array $messages, array $messageGroupRecipients, array $segments): array
    {
        $sender = $this->senderService->get($messages['sender_id']);
        if (empty($sender)) {
            return exceptionObject(400, "Invalid Sender");
        }

        if (! $sender['approved']) {
            return exceptionObject(400, "Sender is not approved");
        }

        $senderConnections = $this->senderConnectionService->getSenderConnections($messages['sender_id']);
        if (empty($senderConnections)) {
            return exceptionObject(400, "Sender is not activated towards any network");
        }

        $numbers = array_reduce($messageGroupRecipients, function ($carry, $messageGroupRecipient) {
            $recipients = array_map(fn($recip) => $recip['number'], $messageGroupRecipient['recipients']);
            return array_merge($carry, $recipients);
        }, []);

        $adjustedSenderConnections = $this->clusterPhoneNumbersRegardingSenderConnections($senderConnections, $numbers);
        if (empty($adjustedSenderConnections['valid_numbers'])) {
            return exceptionObject(400, "No valid numbers found");
        }

        foreach ($adjustedSenderConnections['connections'] as $conn) {
            if (! $conn['approved'] && ! empty($conn['numbers'])) {
                return exceptionObject(400, "Sender is not activated towards ".$conn['smsc']['country']['name'].', '.$conn['smsc']['operator']['name']);
            }
        }

        $wordFilterThreshold = castSettings($this->communicationEngine->broadcast("settings:get", Settings::WORD_FILTER_THRESHOLD->value)[0]);
        $censoredWords = array_map(fn ($word) => $word['name'], $this->messageFilterService->list(1000000000000)['data']);
        $language = $this->messageLanguageService->get($messages['message_language_id']);

        foreach ($messages['content']['messages'] as $message) {

            $result = findSimilarWords($message['content'], $censoredWords, $wordFilterThreshold);
            if (! empty($result)) {
                return exceptionObject(400, "The word: ".$result[0]['text_word']." Is matching the censored word: ".$result[0]['blacklisted_word']." Therefore, we recommend changing it");
            }

            // if (! empty(array_diff(str_split($message['content']), str_split($language['characters']." \b\t\r\n")))) {
            //     return exceptionObject(400, "Invalid message langauage");
            // }
        }

        $maxNumOfSegments = castSettings($this->communicationEngine->broadcast("settings:get", Settings::MAXIMUM_NUMBER_OF_MESSAGES_SEGMENTS->value)[0]);
        if ($maxNumOfSegments < $this->getMaximumNumberOfSegments($messages['content']['messages'])) {
            return exceptionObject(400, "Maximum number of segments exceeded");
        }

        $lastOrder = $this->communicationEngine->broadcast("expense:order:get-client-latest-order", $userID)[0];
        if (empty($lastOrder)) {
            return exceptionObject(400, "You didn't make any orders yet");
        }

        if (! array_key_exists('pricelist', $lastOrder) || empty($lastOrder['pricelist']) ||
            ! array_key_exists('price', $lastOrder['pricelist']) || empty($lastOrder['pricelist']['price'])) {
                return exceptionObject(400, "Invalid price list");
        }

        $messages['single_message_cost'] = $lastOrder['pricelist']['price'];

        $approved = false;
        $messageApprovmentLimit = castSettings($this->communicationEngine->broadcast("settings:get", Settings::MESSAGE_APPROVEMENT_LIMIT->value)[0]);
        $numberOfRecipients = $this->getTotalNumberOfRecipients($messageGroupRecipients);
        if ($numberOfRecipients < $messageApprovmentLimit) {
            $approved = true;
        }

        $recipients = [];
        foreach ($messageGroupRecipients as $messageGroupRecipient) {
            $msgrcp = $this->messageGroupService->add([
                'name' => $messageGroupRecipient['name'],
                'user_id' => $messageGroupRecipient['user_id'],
                'number_of_recipients' => count($messageGroupRecipient['recipients'])
            ], $messageGroupRecipient['recipients']);
            array_push($recipients, ...$msgrcp);
        }

        if (! $approved) {
            $this->notifyMessageApproval();
        }

        $status = array_key_exists('scheduled_at', $messages) && Carbon::parse($messages['scheduled_at'])->gte(Carbon::now()) ? 'Scheduled' :  ($approved ? 'Sent' : 'Pending');

        foreach ($messages['content']['messages'] as $message) {
            if ($approved) {
                // send the message
                $connection = arrayFind($adjustedSenderConnections['connections'], fn ($conn) => in_array($message['title'], $conn['numbers']));
                $this->messageDriver->sendMessage($sender['name'], $connection['smsc']['smsc']['value'], $message['content'], [$message['title']], $language['name']);
            }

            $insertedMessage =  $this->messageDatabaseService->addMessage([
                'user_id' => $messages['user_id'],
                'sender_id' => $messages['sender_id'],
                'order_id' => $messages['order_id'],
                'message_language_id' => $messages['message_language_id'],
                'approved' => $approved,
                'content' => $message['content'],
                'length' => mb_strlen($message['content'], 'UTF-8'),
                'notes' => array_key_exists('notes', $messages)? $messages['notes'] : null,
                'single_message_cost' => $messages['single_message_cost'],
                'total_cost' => $messages['single_message_cost'] * count($message['segments']),
                'scheduled_at' => array_key_exists('scheduled_at', $messages)? $messages['scheduled_at'] : date("Y-m-d H:i:s"),
                'sent' => ($status == 'Sent'),
                'number_of_segments' => count($message['segments']),
                'number_of_recipients' => 1,
                'sender_ip' => $messages['sender_ip'],
                'send_type' => $messages['send_type'],
                'draft' => $messages['draft'] ?? false,
                'message_type' => $this->isTheAuthenticatedUserAdmin() ? 'Admin' : 'Client',
            ]);

            $this->messageSegmentService->add($insertedMessage['id'], $message['segments']);

            $this->messageRecipientService->add($insertedMessage['id'], [arrayFind($recipients, function ($recipient) use ($message) {
                return $recipient['number'] === $message['title'];
            })['id']], $status);

            $totalCost =(float) number_format($messages['single_message_cost'] * count($message['segments']), 2, '.', '');

            $this->communicationEngine->broadcast(
                "core:client:update-client-wallet", 
                $userID, 
                $totalCost, 
                WalletActions::DEDUCT->value
            );
        }

        return $messages;    
    }





    public function update(string $messageID, array $message): array
    {
        if (array_key_exists('approved', $message) && $message['approved']) {

            $msg = $this->get($messageID);
            $msg['recipients'] = $this->getMessageRecipients($msg['id'], 1000000)['data'];
            $msg = $this->updateAndSendMessage($msg);

            $now = strtotime(date('Y-m-d H:i:s'));
            $scheduledTime = strtotime($msg['scheduled_at']);
            if (empty($msg['scheduled_at']) || $scheduledTime <= $now) {
                $message['sent'] = true;
            }
        }

        if (array_key_exists('scheduled_at', $message)) {
            $msg = $this->get($messageID);
            $msg['recipients'] = $this->getMessageRecipients($msg['id'], 1000000)['data'];
            $now = strtotime(date('Y-m-d H:i:s'));
            $scheduledTime = strtotime($message['scheduled_at']);

            if (empty($message['scheduled_at']) && $scheduledTime > $now) {
                $this->communicationEngine->broadcast(
                    "core:client:update-client-wallet", 
                    $msg['user_id'], 
                    $msg['total_cost'], 
                    WalletActions::REFUND->value
                );
            }

            if (! empty($message['scheduled_at']) && $msg['approved'] && ($now - $scheduledTime) <= 60) {
                $msg = $this->updateAndSendMessage($msg);
            }
        }

        return $this->messageDatabaseService->updateMessage($messageID, $message);
    }

    public function sendScheduledMessages(): void
    {
        $messages = $this->messageDatabaseService->getReadyToSendScheduledMessages();
        if (! empty($messages)) {
            foreach ($messages as $message) {
                $this->updateAndSendMessage($message);
                $this->messageDatabaseService->updateMessage($message['id'], ['sent' => true]);
            }
        }
    }

    public function delete(string $messageID): bool
    {
        $msg = $this->get($messageID);
        $this->communicationEngine->broadcast(
            "core:client:update-client-wallet", 
            $msg['user_id'], 
            $msg['total_cost'], 
            WalletActions::REFUND->value
        );

        return $this->messageDatabaseService->deleteMessage($messageID) && 
                $this->messageSegmentService->delete($messageID) &&
                $this->messageRecipientService->delete($messageID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        switch ($column) {
            case "company":
            case "company_name":
                $clients = $this->communicationEngine->broadcast("core:client:search-column", "company_name", $value, true, 1000000000000)[0];
                $usersID = array_unique(array_column($clients['data'], 'user_id'));
                $messages = $this->getMessagesByUsersID($usersID, $take);
                $messages['data'] = tableWith($messages['data'], $clients['data'], 'user_id', 'user_id', 'client');
                $senders = $this->senderService->getSendersByUsersID($usersID, 1000000000000);
                $sendersID = array_unique(array_column($senders['data'], 'id'));
                $messages['data'] = tableWith($messages['data'], $senders['data'], 'sender_id');
                $ordersID = array_unique(array_column($messages['data'], 'order_id'));
                $orders = $this->communicationEngine->broadcast("expense:order:get-orders-by-id", $ordersID, 1000000000000)[0];
                $messages['data'] = tableWith($messages['data'], $orders['data'], 'order_id');
                return $messages;
                break;

            case "sender":
            case "sender_name":
                $senders = $this->senderService->searchColumn("name", $value, 1000000000000);
                $sendersID = array_unique(array_column($senders['data'], 'id'));
                $messages = $this->getMessagesBySendersID($sendersID, $take);
                $messages['data'] = tableWith($messages['data'], $senders['data'], 'sender_id');
                $usersID = array_unique(array_column($messages['data'], 'user_id'));
                $clients = $this->communicationEngine->broadcast("core:client:get-clients", $usersID)[0];
                $messages['data'] = tableWith($messages['data'], $clients, 'user_id', 'user_id', 'client');
                $ordersID = array_unique(array_column($messages['data'], 'order_id'));
                $orders = $this->communicationEngine->broadcast("expense:order:get-orders-by-id", $ordersID, 1000000000000)[0];
                $messages['data'] = tableWith($messages['data'], $orders['data'], 'order_id');
                return $messages;
                break;

            case "cost":
            case "pricelist":
            case "pricelist_name":
                $orders = $this->communicationEngine->broadcast("expense:order:search-column", "pricelist", $value, 1000000000000)[0];
                $ordersID = array_unique(array_column($orders['data'], 'id'));
                $messages = $this->getMessagesByOrdersID($ordersID, $take);
                $messages['data'] = tableWith($messages['data'], $orders['data'], 'order_id');
                $usersID = array_unique(array_column($messages['data'], 'user_id'));
                $clients = $this->communicationEngine->broadcast("core:client:get-clients", $usersID)[0];
                $messages['data'] = tableWith($messages['data'], $clients, 'user_id', 'user_id', 'client');
                $sendersID = array_unique(array_column($messages['data'], 'sender_id'));
                $senders = $this->senderService->getSendersByID($sendersID);
                $messages['data'] = tableWith($messages['data'], $senders, 'sender_id');
                return $messages;
                break;

            default:
                $messages = $this->messageDatabaseService->searchMessageColumn($column, $value, $take);
                $sendersID = array_unique(array_column($messages['data'], 'sender_id'));
                $senders = $this->senderService->getSendersByID($sendersID);
                $messages['data'] = tableWith($messages['data'], $senders, "sender_id");
                $usersID = array_unique(array_column($messages['data'], 'user_id'));
                $clients = $this->communicationEngine->broadcast("core:client:get-clients", $usersID)[0];
                $messages['data'] = tableWith($messages['data'], $clients, 'user_id', 'user_id', 'client');
                $ordersID = array_unique(array_column($messages['data'], 'order_id'));
                $orders = $this->communicationEngine->broadcast("expense:order:get-orders-by-id", $ordersID, 1000000000000)[0];
                $messages['data'] = tableWith($messages['data'], $orders['data'], 'order_id');
                return $messages;
        }
    }





    public function oldApiSendBulk(array $inputs): mixed
    {
        if (! array_key_exists('message', $inputs) || empty($inputs['message'])) {
            return "Message is required";
        }

        if (! array_key_exists('mobiles', $inputs) || empty($inputs['mobiles'])) {
            return "Mobiles numbers are required";
        }

        if (! array_key_exists('api_key', $inputs) || empty($inputs['api_key'])) {
            return "API Key is required";
        }

        if (! array_key_exists('username', $inputs) || empty($inputs['username']) ||
            ! array_key_exists('password', $inputs) || empty($inputs['password'])) {
            return "Invalid user name or password";
        }

        $user = $this->communicationEngine->broadcast("auth:user:get-user-by-username", $inputs['username'])[0];

        if (empty($user)) {
            return "Invalid access credentials";
        }

        $this->communicationEngine->broadcast("auth:user:attempt-credentials", $inputs['username'], $inputs['password'])[0];


        $client = $this->communicationEngine->broadcast("core:client:get-client", $user['id'])[0];

        if (! array_key_exists('use_api_key', $client) || ! $client['use_api_key']) {
            return "You don't have permission to use API service";
        }

        if (! array_key_exists('api_key', $client) || $inputs['api_key'] !== $client['api_key']) {
            return "Invalid api key";
        }

        $allowedIPAddresses = $this->ipWhitelistService->getUserAllowedWhitelist($client['user_id']);
        if ((array_key_exists('use_ip_address', $client) && $client['use_ip_address']) &&
            // (! array_key_exists('ip_address', $client) || ! in_array($inputs['ip_address'], explode("-", $client['ip_address'])))) 
            (empty($allowedIPAddresses) || empty(arrayFind($allowedIPAddresses, fn ($ip) => $ip['ip_address'] == $inputs['ip_address']))))
        {
            return "Invalid IP Address";
        }

        $senders = $this->senderService->getClientSenders($user['id']);
        $sender = arrayFind($senders, fn ($snd) => $snd['name'] === $inputs['sender']);
        if (empty($sender)) {
            return "Invalid sender";
        }

        if (! $sender['approved']) {
            return "Sender is not approved";
        }

        $senderConnections = $this->senderConnectionService->getSenderConnections($sender['id']);
        if (empty($senderConnections)) {
            return "Sender ID is not activated towards any network";
        }

        $adjustedSenderConnections = $this->clusterPhoneNumbersRegardingSenderConnections($senderConnections, $inputs['mobiles']);
        if (empty($adjustedSenderConnections['valid_numbers'])) {
            return "No valid mobile numbers found";
        }

        foreach ($adjustedSenderConnections['connections'] as $conn) {
            if (! $conn['approved'] && ! empty($conn['numbers'])) {
                return "Sender ID is not activated towards ".$conn['smsc']['country']['name'].', '.$conn['smsc']['operator']['name'];
            }
        }

        $wordFilterThreshold = castSettings($this->communicationEngine->broadcast("settings:get", Settings::WORD_FILTER_THRESHOLD->value)[0]);
        $censoredWords = array_map(fn ($word) => $word['name'], $this->messageFilterService->list(1000000000000)['data']);
        $result = findSimilarWords($inputs['message'], $censoredWords, $wordFilterThreshold);
        if (! empty($result)) {
            return "The word: ".$result[0]['text_word']." Is matching the censored word: ".$result[0]['blacklisted_word']." Therefore, we recommend changing it";
        }

        $languageName = "english";
        $characters = mb_str_split($inputs['message']);
        foreach ($characters as $chr) {
            $ascii_code = mb_ord($chr, 'UTF-8');
            if ($ascii_code >= 1548 && $ascii_code <= 1746) {
                $languageName = "arabic";
                break;
            }
        }

        $language = $this->messageLanguageService->getByName($languageName);
        if (empty($language)) {
            return "Invalid message langauage";
        }

        $segments = $this->getMessageSegments($inputs['message'], $language);
        $numberOfSegments = count($segments);
        $maxNumOfSegments = castSettings($this->communicationEngine->broadcast("settings:get", Settings::MAXIMUM_NUMBER_OF_MESSAGES_SEGMENTS->value)[0]);
        if ($maxNumOfSegments < $numberOfSegments) {
            return "Maximum number of segments exceeded";
        }

        $lastOrder = $this->communicationEngine->broadcast("expense:order:get-client-latest-order", $user['id'])[0];
        if (empty($lastOrder)) {
            return "You didn't make any order, please make an order to charge your account";
        }

        if (! array_key_exists('pricelist', $lastOrder) || empty($lastOrder['pricelist']) ||
            ! array_key_exists('price', $lastOrder['pricelist']) || empty($lastOrder['pricelist']['price'])) {
            return "Invalid price list";
        }

        $messageCost = $lastOrder['pricelist']['price'];
        $numberOfRecipients = count($adjustedSenderConnections['valid_numbers']);
        $totalCost = (float) number_format($messageCost * $numberOfSegments * $numberOfRecipients, 2, '.', '');

        if (! array_key_exists('balance', $client) || $client['balance'] < $totalCost) {
            return "Not enough balance";
        }

        $this->communicationEngine->broadcast(
            "core:client:update-client-wallet", 
            $user['id'], 
            $totalCost, 
            WalletActions::DEDUCT->value
        );

        $approved = false;
        $messageApprovmentLimit = castSettings($this->communicationEngine->broadcast("settings:get", Settings::MESSAGE_APPROVEMENT_LIMIT->value)[0]);
        if ($numberOfRecipients < $messageApprovmentLimit) {
            $approved = true;
        }

        if ($approved) {
            // send the message
            foreach ($adjustedSenderConnections['connections'] as $conn) {
                $this->messageDriver->sendMessage($sender['name'], $conn['smsc']['smsc']['value'], $inputs['message'], $conn['numbers'], $language['name']);
            }
        } else {
            $this->notifyMessageApproval();
        }

        $status = array_key_exists('scheduled_at', $inputs) && Carbon::parse($inputs['scheduled_at'])->gte(Carbon::now()) ? 'Scheduled' :  ($approved ? 'Sent' : 'Pending');

        $message = $this->messageDatabaseService->addMessage([
            'user_id' => $user['id'],
            'sender_id' => $sender['id'],
            'order_id' => $lastOrder['id'],
            'message_language_id' => $language['id'],
            'approved' => $approved,
            'content' => $inputs['message'],
            'length' => mb_strlen($inputs['message'], 'UTF-8'),
            'notes' => array_key_exists('notes', $inputs)? $inputs['notes'] : null,
            'single_message_cost' => $messageCost,
            'total_cost' => $totalCost,
            'scheduled_at' => array_key_exists('scheduled_at', $inputs)? $inputs['scheduled_at'] : date("Y-m-d H:i:s"),
            'sent' => ($status == 'Sent'),
            'number_of_segments' => $numberOfSegments,
            'number_of_recipients' => $numberOfRecipients,
            'sender_ip' => $inputs['ip_address'],
            'message_type' => 'API',
        ]);

        $this->messageSegmentService->add($message['id'], $segments);

        $messageGroup = $this->messageGroupService->add([
            'name' => array_key_exists('group_name', $inputs)? $inputs['group_name'] : Str::random(8).'-api-group',
            'user_id' => $user['id'],
            'number_of_recipients' => count($adjustedSenderConnections['valid_numbers'])
        ], array_map(fn ($num) => ['number' => $num], $adjustedSenderConnections['valid_numbers']));

        $this->messageRecipientService->add($message['id'], array_column($messageGroup, 'id'), 'Sent');

        return [
            'new_msg_id' => $message['id'],
            'transaction_price' => (float) number_format($totalCost, 2, '.', ''),
            'net_balance' => (float) number_format($client['balance'], 2, '.', ''),
        ];
    }





    public function oldApiCheckBalance(array $inputs): mixed
    {
        if (! array_key_exists('api_key', $inputs) || empty($inputs['api_key'])) {
            return "API Key is required";
        }

        if (! array_key_exists('username', $inputs) || empty($inputs['username']) ||
            ! array_key_exists('password', $inputs) || empty($inputs['password'])) {
            return "Invalid user name or password";
        }

        $user = $this->communicationEngine->broadcast("auth:user:get-user-by-username", $inputs['username'])[0];

        if (empty($user)) {
            return "Invalid access credentials";
        }

        $this->communicationEngine->broadcast("auth:user:attempt-credentials", $inputs['username'], $inputs['password'])[0];


        $client = $this->communicationEngine->broadcast("core:client:get-client", $user['id'])[0];

        if (! array_key_exists('use_api_key', $client) || ! $client['use_api_key']) {
            return "You don't have permission to use API service";
        }

        if (! array_key_exists('api_key', $client) || $inputs['api_key'] !== $client['api_key']) {
            return "Invalid api key";
        }

        $allowedIPAddresses = $this->ipWhitelistService->getUserAllowedWhitelist($client['user_id']);
        if ((array_key_exists('use_ip_address', $client) && $client['use_ip_address']) &&
            // (! array_key_exists('ip_address', $client) || ! in_array($inputs['ip_address'], explode("-", $client['ip_address'])))) 
            (empty($allowedIPAddresses) || empty(arrayFind($allowedIPAddresses, fn ($ip) => $ip['ip_address'] == $inputs['ip_address']))))
        {
            return "Invalid IP Address";
        }

        return [
            'balance' => (float) number_format($client['balance'], 2, '.', '')
        ];
    }





    public function sendMessage(array $inputs): mixed
    {
        $user = $this->communicationEngine->broadcast("auth:user:get-auth-user")[0];
        $client = $this->communicationEngine->broadcast("core:client:get-client", $user['id'])[0];

        if (! array_key_exists('use_api_key', $client) || ! $client['use_api_key']) {
            return exceptionObject(400, "You don't have permission to use API service");
        }

        $allowedIPAddresses = $this->ipWhitelistService->getUserAllowedWhitelist($client['user_id']);
        if ((array_key_exists('use_ip_address', $client) && $client['use_ip_address']) &&
            // (! array_key_exists('ip_address', $client) || ! in_array($inputs['ip_address'], explode("-", $client['ip_address'])))) 
            (empty($allowedIPAddresses) || empty(arrayFind($allowedIPAddresses, fn ($ip) => $ip['ip_address'] == $inputs['ip_address']))))
        {
            return "Invalid IP Address";
        }

        $senders = $this->senderService->getClientSenders($user['id']);
        $sender = arrayFind($senders, fn ($snd) => $snd['name'] === $inputs['sender']);
        if (empty($sender)) {
            return exceptionObject(400, "Invalid Sender");
        }

        if (! $sender['approved']) {
            return exceptionObject(400, "Sender is not approved");
        }

        $senderConnections = $this->senderConnectionService->getSenderConnections($sender['id']);
        if (empty($senderConnections)) {
            return exceptionObject(400, "Sender is not activated towards any network");
        }

        $adjustedSenderConnections = $this->clusterPhoneNumbersRegardingSenderConnections($senderConnections, $inputs['numbers']);
        if (empty($adjustedSenderConnections['valid_numbers'])) {
            return exceptionObject(400, "No valid numbers found");
        }

        foreach ($adjustedSenderConnections['connections'] as $conn) {
            if (! $conn['approved'] && ! empty($conn['numbers'])) {
                return exceptionObject(400, "Sender is not activated towards ".$conn['smsc']['country']['name'].', '.$conn['smsc']['operator']['name']);
            }
        }

        $wordFilterThreshold = castSettings($this->communicationEngine->broadcast("settings:get", Settings::WORD_FILTER_THRESHOLD->value)[0]);
        $censoredWords = array_map(fn ($word) => $word['name'], $this->messageFilterService->list(1000000000000)['data']);
        $result = findSimilarWords($inputs['message'], $censoredWords, $wordFilterThreshold);
        if (! empty($result)) {
            return exceptionObject(400, "The word: ".$result[0]['text_word']." Is matching the censored word: ".$result[0]['blacklisted_word']." Therefore, we recommend changing it");
        }

        $language = $this->messageLanguageService->getByName($inputs['language']);
        if (! empty(array_diff(str_split($inputs['message']), str_split($language['characters']." \b\t\r\n")))) {
            return exceptionObject(400, "Invalid message langauage");
        }

        $segments = $this->getMessageSegments($inputs['message'], $language);
        $numberOfSegments = count($segments);
        $maxNumOfSegments = castSettings($this->communicationEngine->broadcast("settings:get", Settings::MAXIMUM_NUMBER_OF_MESSAGES_SEGMENTS->value)[0]);
        if ($maxNumOfSegments < $numberOfSegments) {
            return exceptionObject(400, "Maximum number of segments exceeded");
        }

        $lastOrder = $this->communicationEngine->broadcast("expense:order:get-client-latest-order", $user['id'])[0];
        if (empty($lastOrder)) {
            return exceptionObject(400, "You didn't make any order, please make an order to charge your account");
        }

        if (! array_key_exists('pricelist', $lastOrder) || empty($lastOrder['pricelist']) ||
            ! array_key_exists('price', $lastOrder['pricelist']) || empty($lastOrder['pricelist']['price'])) {
                return exceptionObject(400, "Invalid price list");
        }

        $messageCost = $lastOrder['pricelist']['price'];
        $numberOfRecipients = count($adjustedSenderConnections['valid_numbers']);
        $totalCost = (float) number_format($messageCost * $numberOfSegments * $numberOfRecipients, 2, '.', '');

        $this->communicationEngine->broadcast(
            "core:client:update-client-wallet", 
            $user['id'], 
            $totalCost, 
            WalletActions::DEDUCT->value
        );

        $approved = false;
        $messageApprovmentLimit = castSettings($this->communicationEngine->broadcast("settings:get", Settings::MESSAGE_APPROVEMENT_LIMIT->value)[0]);
        if ($numberOfRecipients < $messageApprovmentLimit) {
            $approved = true;
        }

        if ($approved) {
            // send the message
            foreach ($adjustedSenderConnections['connections'] as $conn) {
                $this->messageDriver->sendMessage($sender['name'], $conn['smsc']['smsc']['value'], $inputs['message'], $conn['numbers'], $language['name']);
            }
        } else {
            $this->notifyMessageApproval();
        }

        $status = array_key_exists('scheduled_at', $inputs) && Carbon::parse($inputs['scheduled_at'])->gte(Carbon::now()) ? 'Scheduled' :  ($approved ? 'Sent' : 'Pending');

        $message = $this->messageDatabaseService->addMessage([
            'user_id' => $user['id'],
            'sender_id' => $sender['id'],
            'order_id' => $lastOrder['id'],
            'message_language_id' => $language['id'],
            'approved' => $approved,
            'content' => $inputs['message'],
            'length' => mb_strlen($inputs['message'], 'UTF-8'),
            'notes' => array_key_exists('notes', $inputs)? $inputs['notes'] : null,
            'single_message_cost' => $messageCost,
            'total_cost' => $totalCost,
            'scheduled_at' => array_key_exists('scheduled_at', $inputs)? $inputs['scheduled_at'] : date("Y-m-d H:i:s"),
            'sent' => ($status == 'Sent'),
            'number_of_segments' => $numberOfSegments,
            'number_of_recipients' => $numberOfRecipients,
            'sender_ip' => $inputs['ip_address'],
            'message_type' => 'API',
        ]);

        $messageSegments = $this->messageSegmentService->add($message['id'], $segments);

        $messageGroup = $this->messageGroupService->add([
            'name' => array_key_exists('group_name', $inputs)? $inputs['group_name'] : $sender['name'].'-group',
            'user_id' => $user['id'],
            'number_of_recipients' => count($adjustedSenderConnections['valid_numbers'])
        ], array_map(fn ($num) => ['number' => $num], $adjustedSenderConnections['valid_numbers']));

        $messageResipients = $this->messageRecipientService->add($message['id'], array_column($messageGroup, 'id'), 'Sent');

        return [
            'message' => $message,
            'group' => $messageGroup[0]['message_group'],
            'segments' => array_map(fn ($sgm) => [
                'id' => $sgm['id'],
                'message_id' => $sgm['message_id'],
                'segment_number' => $sgm['segment_number'],
                'segment_content' => $sgm['segment_content'],
                'created_at' => $sgm['created_at'],
                'updated_at' => $sgm['updated_at'],
            ], $messageSegments),
            'recipients' => array_map(fn ($rcp) => [
                'id' => $rcp['id'],
                'message_id' => $rcp['message_id'],
                'status' => $rcp['status'],
                'number' => $rcp['message_group_recipient']['number'],
                'attributes' => $rcp['message_group_recipient']['attributes'],
                'created_at' => $rcp['created_at'],
                'updated_at' => $rcp['updated_at'],
            ], $messageResipients),
        ];
    }




    public function getClientMessagesStats(string $userID): array
    {
        return $this->messageDatabaseService->getClientMessagesStats($userID);
    }




    private function updateAndSendMessage(array $message): array
    {
        $sender = $this->senderService->get($message['sender_id']);
        $numbers = array_map(fn($recip) => $recip['number'], $message['recipients']);
        $senderConnections = $this->senderConnectionService->getSenderConnections($message['sender_id']);
        $adjustedSenderConnections = $this->clusterPhoneNumbersRegardingSenderConnections($senderConnections, $numbers);

        // send the message
        foreach ($adjustedSenderConnections['connections'] as $conn) {
            $this->messageDriver->sendMessage($sender['name'], $conn['smsc']['smsc']['value'], $message['content'], $conn['numbers'], $message['language']['name']);
        }

        $this->messageRecipientService->update($message['id'], ['status' => 'Sent']);
        $message['sent'] = true;
        return $message;
    }

    private function clusterPhoneNumbersRegardingSenderConnections(array $senderConnections, array $phoneNumbers)
    {
        if (empty($phoneNumbers) || empty($senderConnections)) {
            return [];
        }
    
        $adjustedSenderConnections = ['connections' => []];
        $defaultCountryCode = $this->communicationEngine->broadcast("settings:get", Settings::DEFAULT_COUNTRY_CODE->value)[0]['value'];

        foreach ($senderConnections as $conn) {
            $numbers = [];
    
            // if ($conn['smsc']['default']) {
                $numbers = $this->getConnectionPhoneNumbers(
                    $conn['smsc']['country']['code'],
                    $conn['smsc']['operator']['code'],
                    $phoneNumbers,
                    $defaultCountryCode
                );
            // }
    
            $adjustedSenderConnections['connections'][] = array_merge($conn, ['numbers' => $numbers]);
        }
    
        $adjustedSenderConnections['valid_numbers'] = array_unique(
            array_merge(...array_column($adjustedSenderConnections['connections'], 'numbers'))
        );
    
        $validNumbers = array_flip($adjustedSenderConnections['valid_numbers']);
    
        $adjustedSenderConnections['invalid_numbers'] = array_values(
            array_filter($phoneNumbers, function ($number) use ($validNumbers) {
                return !isset($validNumbers[$number]);
            })
        );
    
        return $adjustedSenderConnections;
    }

    private function getConnectionPhoneNumbers(string $countryCode, string $operatorCode, array $phoneNumbers, $defaultCountryCode) {
        if (empty($countryCode) || empty($operatorCode) || empty($phoneNumbers)) {
            return [];
        }

        $adjustedPhoneNumbers = array_map(function ($number) use ($countryCode, $operatorCode, $defaultCountryCode){
            if ($defaultCountryCode === $countryCode) {
                if(stringStartsWith($number, $operatorCode)) {
                    return $countryCode.$number;
                }
                $lastCharacter = substr($countryCode, -1);
                if(stringStartsWith($number, $lastCharacter.$operatorCode)) {
                    return substr($countryCode, 0, -1).$number;
                }
            }
            return $number;
        }, $phoneNumbers);

        return array_values(array_filter($adjustedPhoneNumbers, function ($number) use ($countryCode, $operatorCode) {
            return stringStartsWith($number, $countryCode.$operatorCode);
        }));
    }

    private function getMessageSegments(string $message, array $language): array
    {
        if (empty($language)) {
            return [];
        }

        if (strlen($message) <= $language['max_characters_length']) {
            return [
                [
                    'number' => 1,
                    'content' => $message
                ]
            ];
        }

        $segments = splitMessage($message, $language['split_characters_length']);

        return array_map(fn ($segment, $index) => [
            'number' => $index,
            'content' => $segment
        ], $segments, array_keys($segments));
    }

    private function getMaximumNumberOfSegments(array $messages): int
    {
        $max = 0;

        foreach ($messages as $message) {
            $length = count($message['segments']);

            if ($length > $max) {
                $max = $length;
            }
        }

        return $max;
    }

    private function getTotalNumberOfRecipients(array $groupsRecipients): int
    {
        $total = 0;

        foreach ($groupsRecipients as $groupRecipients) {
            $total += count($groupRecipients['recipients']);
        }

        return $total;
    }

    private function notifyMessageApproval(): void
    {
        $mails = explode(",", config('message.message_approvement_mails'));
        $subject = config('message.message_approvement_subject');
        $content = config('message.message_approvement_content');

        if (! empty($mails)) {
            foreach ($mails as $mail) {
                $this->communicationEngine->broadcast("mail:send-to", $mail, $subject, $content);
            }
        }
    }

    private function isTheAuthenticatedUserAdmin(): bool
    {
        $user = $this->communicationEngine->broadcast("auth:user:get-auth-user")[0];
        if (config('auth.super_admin_username') === $user['username']) {
            return true;
        }
        $client = $this->communicationEngine->broadcast("core:client:get-client", $user['id'])[0];
        return empty($client);
    }
}