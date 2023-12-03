<?php

namespace Epush\Core\Message\App\Service;

use DateTime;
use InvalidArgumentException;
use Epush\Shared\Infra\Utils\Settings;
use Epush\Shared\Infra\Utils\WalletActions;

use Epush\Core\Sender\App\Contract\SenderServiceContract;
use Epush\Core\Message\App\Contract\MessageServiceContract;
use Epush\Core\Message\App\Contract\MessageDatabaseServiceContract;
use Epush\Core\Message\Infra\Driver\MessageDriverContract;
use Epush\Core\MessageFilter\App\Contract\MessageFilterServiceContract;
use Epush\Core\MessageGroup\App\Contract\MessageGroupServiceContract;
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
        $maxNumOfSegments = castSettings($this->communicationEngine->broadcast("settings:get", Settings::MAXIMUM_NUMBER_OF_MESSAGES_SEGMENTS->value)[0]);
        if ($maxNumOfSegments < $message['number_of_segments']) {
            return exceptionObject(400, "Maximum number of segments exceeded");
        }

        $lastOrder = $this->communicationEngine->broadcast("expense:order:get-client-latest-order", $userID)[0];
        $message['single_message_cost'] = $lastOrder['pricelist']['price'];
        $totalCost = $message['single_message_cost'] * $message['number_of_segments'] * $message['number_of_recipients'];
        $message['total_cost'] = $totalCost;

        $approved = false;
        $messageApprovmentLimit = castSettings($this->communicationEngine->broadcast("settings:get", Settings::MESSAGE_APPROVEMENT_LIMIT->value)[0]);
        $numberOfRecipients = $this->getTotalNumberOfRecipients($messageGroupRecipients);
        if ($numberOfRecipients < $messageApprovmentLimit) {
            $approved = true;
            $message['approved'] = $approved;
            $message['sent'] = $approved;
        }

        $message = $this->messageDatabaseService->addMessage($message);
        $this->messageSegmentService->add($message['id'], $segments);

        foreach ($messageGroupRecipients as $messageGroupRecipient) {
            if ($approved) {
                // send the message
                $this->messageDriver->sendMessage(array_map(fn ($recip) => $recip['number'], $messageGroupRecipient['recipients']), $message['content']);
            }

            $msgrcp = $this->messageGroupService->add([
                'name' => $messageGroupRecipient['name'],
                'user_id' => $messageGroupRecipient['user_id']
            ], $messageGroupRecipient['recipients']);
            $this->messageRecipientService->add($message['id'], array_column($msgrcp, 'id'), 'Sent');
        }

        $this->communicationEngine->broadcast(
            "core:client:update-client-wallet", 
            $userID, 
            $totalCost, 
            WalletActions::DEDUCT->value
        );

        return $this->get($message['id']);
    }

    public function bulkAdd(string $userID, array $messages, array $messageGroupRecipients, array $segments): array
    {
        $maxNumOfSegments = castSettings($this->communicationEngine->broadcast("settings:get", Settings::MAXIMUM_NUMBER_OF_MESSAGES_SEGMENTS->value)[0]);
        if ($maxNumOfSegments < $this->getMaximumNumberOfSegments($messages['content']['messages'])) {
            return exceptionObject(400, "Maximum number of segments exceeded");
        }

        $lastOrder = $this->communicationEngine->broadcast("expense:order:get-client-latest-order", $userID)[0];
        if (empty($lastOrder)) {
            return exceptionObject(400, "You didn't make any orders yet");
        }

        $messages['single_message_cost'] = $lastOrder['pricelist']['price'];
        $totalCost = $messages['single_message_cost'] * count($segments);

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
                'user_id' => $messageGroupRecipient['user_id']
            ], $messageGroupRecipient['recipients']);
            array_push($recipients, ...$msgrcp);
        }

        foreach ($messages['content']['messages'] as $message) {
            if ($approved) {
                // send the message
                $this->messageDriver->sendMessage([$message['title']], $message['content']);
            }

            $insertedMessage =  $this->messageDatabaseService->addMessage([
                'user_id' => $messages['user_id'],
                'sender_id' => $messages['sender_id'],
                'order_id' => $messages['order_id'],
                'message_language_id' => $messages['message_language_id'],
                'approved' => $approved,
                'content' => $message['content'],
                'notes' => array_key_exists('notes', $messages)? $messages['notes'] : null,
                'single_message_cost' => $messages['single_message_cost'],
                'total_cost' => $messages['single_message_cost'] * count($message['segments']),
                'scheduled_at' => array_key_exists('scheduled_at', $messages)? $messages['scheduled_at'] : date("Y-m-d H:i:s"),
                'sent' => $approved,
                'number_of_segments' => count($message['segments']),
                'number_of_recipients' => 1
            ]);

            $this->messageSegmentService->add($insertedMessage['id'], $message['segments']);

            $this->messageRecipientService->add($insertedMessage['id'], [arrayFind($recipients, function ($recipient) use ($message) {
                return $recipient['number'] === $message['title'];
            })['id']], 'Sent');
        }

        $this->communicationEngine->broadcast(
            "core:client:update-client-wallet", 
            $userID, 
            $totalCost, 
            WalletActions::DEDUCT->value
        );

        return $messages;    
    }





    public function update(string $messageID, array $message): array
    {
        if (array_key_exists('approved', $message) && $message['approved']) {
            // send the message
            $msg = $this->get($messageID);
            foreach ($msg['recipients'] as $recipient) {
                if (is_array($recipient['message_group_recipient']) && array_key_exists('number', $recipient['message_group_recipient'])) {
                    $this->messageDriver->sendMessage([$recipient['message_group_recipient']['number']], $msg['content']);
                }
            }
            $this->messageRecipientService->update($messageID, ['status' => 'Sent']);
            $message['sent'] = true;
        }

        if (array_key_exists('scheduled_at', $message)) {
            $msg = $this->get($messageID);
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
                // send the message
                foreach ($msg['recipients'] as $recipient) {
                    if (is_array($recipient['message_group_recipient']) && array_key_exists('number', $recipient['message_group_recipient'])) {
                        $this->messageDriver->sendMessage([$recipient['message_group_recipient']['number']], $msg['content']);
                    }
                }
                $this->messageRecipientService->update($messageID, ['status' => 'Sent']);
                $message['sent'] = true;
            }
        }

        return $this->messageDatabaseService->updateMessage($messageID, $message);
    }

    public function sendScheduledMessages(): void
    {
        $messages = $this->messageDatabaseService->getReadyToSendScheduledMessages();
        if (! empty($messages)) {
            foreach ($messages as $message) {
                // send the message
                foreach ($message['recipients'] as $recipient) {
                    if (is_array($recipient['message_group_recipient']) && array_key_exists('number', $recipient['message_group_recipient'])) {
                        $this->messageDriver->sendMessage([$recipient['message_group_recipient']['number']], $message['content']);
                    }
                }
                $this->messageRecipientService->update($message['id'], ['status' => 'Sent']);
                $this->messageDatabaseService->updateMessage($message['id'], ['sent' => true]);
            }
        }
    }

    public function delete(string $messageID): bool
    {
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

        if ((array_key_exists('use_ip_address', $client) && $client['use_ip_address']) &&
            (! array_key_exists('ip_address', $client) || ! in_array($inputs['ip_address'], explode("-", $client['ip_address'])))) {
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
        foreach (str_split($inputs['message']) as $chr) {
            $ascii_code = ord($chr);
            if ($ascii_code >= 1548 and $ascii_code <= 1746) {
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
            return "Maximum message count exceeded";
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
        $totalCost = (float) number_format($messageCost * $numberOfSegments * $numberOfRecipients, 2);

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
            $this->messageDriver->sendMessage($adjustedSenderConnections['valid_numbers'], $inputs['message']);
        }

        $message = $this->messageDatabaseService->addMessage([
            'user_id' => $user['id'],
            'sender_id' => $sender['id'],
            'order_id' => $lastOrder['id'],
            'message_language_id' => $language['id'],
            'approved' => $approved,
            'content' => $inputs['message'],
            'notes' => array_key_exists('notes', $inputs)? $inputs['notes'] : null,
            'single_message_cost' => $messageCost,
            'total_cost' => $totalCost,
            'scheduled_at' => array_key_exists('scheduled_at', $inputs)? $inputs['scheduled_at'] : date("Y-m-d H:i:s"),
            'sent' => $approved,
            'number_of_segments' => $numberOfSegments,
            'number_of_recipients' => $numberOfRecipients
        ]);

        $this->messageSegmentService->add($message['id'], $segments);

        $messageGroup = $this->messageGroupService->add([
            'name' => array_key_exists('group_name', $inputs)? $inputs['group_name'] : $sender['name'].'-group',
            'user_id' => $user['id']
        ], array_map(fn ($num) => ['number' => $num], $adjustedSenderConnections['valid_numbers']));

        $this->messageRecipientService->add($message['id'], array_column($messageGroup, 'id'), 'Sent');

        return [
            'new_msg_id' => $message['id'],
            'transaction_price' => $totalCost,
            'net_balance' => $client['balance'],
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

        if ((array_key_exists('use_ip_address', $client) && $client['use_ip_address']) &&
            (! array_key_exists('ip_address', $client) || ! in_array($inputs['ip_address'], explode("-", $client['ip_address'])))) {
            return "Invalid IP Address";
        }

        return [
            'balance' => $client['balance']
        ];
    }





    public function sendMessage(array $inputs): array
    {
        $user = $this->communicationEngine->broadcast("auth:user:get-auth-user")[0];
        $client = $this->communicationEngine->broadcast("core:client:get-client", $user['id'])[0];

        if (! array_key_exists('use_api_key', $client) || ! $client['use_api_key']) {
            return exceptionObject(400, "You don't have permission to use API service");
        }

        if ((array_key_exists('use_ip_address', $client) && $client['use_ip_address']) &&
            (! array_key_exists('ip_address', $client) || ! in_array($inputs['ip_address'], explode("-", $client['ip_address'])))) {
                return exceptionObject(400, "Invalid IP Address");
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
            return exceptionObject(400, "Maximum message count exceeded");
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
        $totalCost = (float) number_format($messageCost * $numberOfSegments * $numberOfRecipients, 2);

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
            $this->messageDriver->sendMessage($adjustedSenderConnections['valid_numbers'], $inputs['message']);
        }

        $message = $this->messageDatabaseService->addMessage([
            'user_id' => $user['id'],
            'sender_id' => $sender['id'],
            'order_id' => $lastOrder['id'],
            'message_language_id' => $language['id'],
            'approved' => $approved,
            'content' => $inputs['message'],
            'notes' => array_key_exists('notes', $inputs)? $inputs['notes'] : null,
            'single_message_cost' => $messageCost,
            'total_cost' => $totalCost,
            'scheduled_at' => array_key_exists('scheduled_at', $inputs)? $inputs['scheduled_at'] : date("Y-m-d H:i:s"),
            'sent' => $approved,
            'number_of_segments' => $numberOfSegments,
            'number_of_recipients' => $numberOfRecipients
        ]);

        $messageSegments = $this->messageSegmentService->add($message['id'], $segments);

        $messageGroup = $this->messageGroupService->add([
            'name' => array_key_exists('group_name', $inputs)? $inputs['group_name'] : $sender['name'].'-group',
            'user_id' => $user['id']
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




    private function clusterPhoneNumbersRegardingSenderConnections(array $senderConnections, array $phoneNumbers) {
        if (empty($phoneNumbers) || empty($senderConnections)) {
            return [];
        }

        $adjustedSenderConnections['connections'] = array_map(fn ($conn) => [
            ...$conn,
            'numbers' => $this->getConnectionPhoneNumbers($conn['smsc']['country']['code'], $conn['smsc']['operator']['code'], $phoneNumbers)
        ], $senderConnections);

        $adjustedSenderConnections['valid_numbers'] = array_unique(array_merge(...array_map(fn ($conn) => $conn['numbers'], $adjustedSenderConnections['connections'])));
        $adjustedSenderConnections['invalid_numbers'] = array_values(array_filter($phoneNumbers, function ($number) use ($adjustedSenderConnections) {
            return ! in_array($number, array_map(fn ($num) => substr($num, - strlen($number)), $adjustedSenderConnections['valid_numbers']));
        }));
        return $adjustedSenderConnections;
    }

    private function getConnectionPhoneNumbers(string $countryCode, string $operatorCode, array $phoneNumbers) {
        if (empty($countryCode) || empty($operatorCode) || empty($phoneNumbers)) {
            return [];
        }

        $defaultCountryCode = $this->communicationEngine->broadcast("settings:get", Settings::DEFAULT_COUNTRY_CODE->value)[0]['value'];
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
}