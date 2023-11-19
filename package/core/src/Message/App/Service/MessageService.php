<?php

namespace Epush\Core\Message\App\Service;

use InvalidArgumentException;
use Epush\Shared\Infra\Utils\Settings;
use Epush\Shared\Infra\Utils\WalletActions;

use Epush\Core\Sender\App\Contract\SenderServiceContract;
use Epush\Core\Message\App\Contract\MessageServiceContract;
use Epush\Core\Message\App\Contract\MessageDatabaseServiceContract;
use Epush\Core\MessageGroup\App\Contract\MessageGroupServiceContract;
use Epush\Core\MessageSegment\App\Contract\MessageSegmentServiceContract;
use Epush\Core\MessageRecipient\App\Contract\MessageRecipientServiceContract;
use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class MessageService implements MessageServiceContract
{
    public function __construct(

        private SenderServiceContract $senderService,
        private MessageGroupServiceContract $messageGroupService,
        private MessageSegmentServiceContract $messageSegmentService,
        private MessageDatabaseServiceContract $messageDatabaseService,
        private MessageRecipientServiceContract $messageRecipientService,
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
            throw new InvalidArgumentException("Maximum number of segments exceeded");
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
        }

        if ($approved) {
            // send the message
        }

        $message = $this->messageDatabaseService->addMessage($message);
        $this->messageSegmentService->add($message['id'], $segments);

        foreach ($messageGroupRecipients as $messageGroupRecipient) {
            $msgrcp = $this->messageGroupService->add([
                'name' => $messageGroupRecipient['name'],
                'user_id' => $messageGroupRecipient['user_id']
            ], $messageGroupRecipient['recipients']);
            $this->messageRecipientService->add($message['id'], array_column($msgrcp, 'id'));
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
            throw new InvalidArgumentException("Maximum number of segments exceeded");
        }

        $lastOrder = $this->communicationEngine->broadcast("expense:order:get-client-latest-order", $userID)[0];
        $messages['single_message_cost'] = $lastOrder['pricelist']['price'];
        $totalCost = $messages['single_message_cost'] * count($segments);

        $approved = false;
        $messageApprovmentLimit = castSettings($this->communicationEngine->broadcast("settings:get", Settings::MESSAGE_APPROVEMENT_LIMIT->value)[0]);
        $numberOfRecipients = $this->getTotalNumberOfRecipients($messageGroupRecipients);
        if ($numberOfRecipients < $messageApprovmentLimit) {
            $approved = true;
        }

        if ($approved) {
            // send the message
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
                'number_of_segments' => count($message['segments']),
                'number_of_recipients' => 1
            ]);

            $this->messageSegmentService->add($insertedMessage['id'], $message['segments']);

            $this->messageRecipientService->add($insertedMessage['id'], [arrayFind($recipients, function ($recipient) use ($message) {
                return $recipient['number'] === $message['title'];
            })['id']]);
        }

        $this->communicationEngine->broadcast(
            "core:client:update-client-wallet", 
            $userID, 
            $totalCost, 
            WalletActions::DEDUCT->value
        );

        return $messages;    }

    public function update(string $messageID, array $message): array
    {
        if (array_key_exists('approved', $message) && $message['approved']) {
            //send the message
        }

        if (array_key_exists('scheduled_at', $message) && empty($message['scheduled_at'])) {
            $msg = $this->get($messageID);
            $this->communicationEngine->broadcast(
                "core:client:update-client-wallet", 
                $msg['user_id'], 
                $msg['total_cost'], 
                WalletActions::REFUND->value
            );
        }

        return $this->messageDatabaseService->updateMessage($messageID, $message);
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

    private function getMaximumNumberOfSegments(array $messages)
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

    private function getTotalNumberOfRecipients(array $groupsRecipients)
    {
        $total = 0;

        foreach ($groupsRecipients as $groupRecipients) {
            $total += count($groupRecipients['recipients']);
        }

        return $total;
    }
}