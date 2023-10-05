<?php

namespace Epush\Core\Message\App\Service;

use Epush\Core\Message\App\Contract\MessageDatabaseServiceContract;
use Epush\Core\Message\Infra\Database\Driver\MessageDatabaseDriverContract;

class MessageDatabaseService implements MessageDatabaseServiceContract
{
    public function __construct(

        private MessageDatabaseDriverContract $messageDatabaseDriver

    ) {}

    public function getMessage(string $messageID): array
    {
        return $this->messageDatabaseDriver->messageRepository()->get($messageID);
    }

    public function getClientMessages(string $userID): array
    {
        return $this->messageDatabaseDriver->messageRepository()->getClientMessages($userID);
    }

    public function getMessagesByUsersID(array $usersID, int $take = 10): array
    {
        return $this->messageDatabaseDriver->messageRepository()->getMessagesByUsersID($usersID, $take);
    }

    public function getMessagesByOrdersID(array $ordersID, int $take = 10): array
    {
        return $this->messageDatabaseDriver->messageRepository()->getMessagesByOrdersID($ordersID, $take);
    }

    public function getMessagesBySendersID(array $sendersID, int $take = 10): array
    {
        return $this->messageDatabaseDriver->messageRepository()->getMessagesBySendersID($sendersID, $take);
    }

    public function paginateMessages(int $take): array
    {
        return $this->messageDatabaseDriver->messageRepository()->all($take);
    }

    public function addMessage(array $message): array
    {
        return $this->messageDatabaseDriver->messageRepository()->create($message);
    }

    public function bulkAddMessage(array $messages): array
    {
        return $this->messageDatabaseDriver->messageRepository()->insert($messages);
    }

    public function updateMessage(string $messageID, array $message): array
    {
        return $this->messageDatabaseDriver->messageRepository()->update($messageID, $message);
    }

    public function deleteMessage(string $messageID): bool
    {
        return $this->messageDatabaseDriver->messageRepository()->delete($messageID);
    }

    public function searchMessageColumn(string $column, string $value, int $take = 10): array
    {
        return $this->messageDatabaseDriver->messageRepository()->searchColumn($column, $value, $take);
    }
}