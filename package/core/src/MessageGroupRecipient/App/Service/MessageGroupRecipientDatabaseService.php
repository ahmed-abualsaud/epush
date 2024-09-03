<?php

namespace Epush\Core\MessageGroupRecipient\App\Service;

use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientDatabaseServiceContract;
use Epush\Core\MessageGroupRecipient\Infra\Database\Driver\MessageGroupRecipientDatabaseDriverContract;

class MessageGroupRecipientDatabaseService implements MessageGroupRecipientDatabaseServiceContract
{
    public function __construct(

        private MessageGroupRecipientDatabaseDriverContract $messageGroupRecipientDatabaseDriver

    ) {}

    public function getMessageGroupRecipient(string $messageGroupRecipientID): array
    {
        return $this->messageGroupRecipientDatabaseDriver->messageGroupRecipientRepository()->get($messageGroupRecipientID);
    }

    public function paginateMessageGroupRecipients(int $take): array
    {
        return $this->messageGroupRecipientDatabaseDriver->messageGroupRecipientRepository()->all($take);
    }

    public function addMessageGroupRecipients(string $groupID, array $messageGroupRecipients): array
    {
        return $this->messageGroupRecipientDatabaseDriver->messageGroupRecipientRepository()->insert($groupID, $messageGroupRecipients);
    }

    public function addMessageGroupAndGetRecipients(string $groupID, array $messageGroupRecipients): array
    {
        return $this->messageGroupRecipientDatabaseDriver->messageGroupRecipientRepository()->insertAndFetch($groupID, $messageGroupRecipients);
    }

    public function updateMessageGroupRecipient(string $messageGroupRecipientID, array $messageGroupRecipient): array
    {
        return $this->messageGroupRecipientDatabaseDriver->messageGroupRecipientRepository()->update($messageGroupRecipientID, $messageGroupRecipient);
    }

    public function deleteMessageGroupRecipient(string $messageGroupRecipientID): bool
    {
        return $this->messageGroupRecipientDatabaseDriver->messageGroupRecipientRepository()->delete($messageGroupRecipientID);
    }

    public function deleteMessageGroupRecipients(string $groupID): bool
    {
        return $this->messageGroupRecipientDatabaseDriver->messageGroupRecipientRepository()->deleteGroupRecipients($groupID);
    }

    public function searchMessageGroupRecipientColumn(string $column, string $value, int $take = 10): array
    {
        return $this->messageGroupRecipientDatabaseDriver->messageGroupRecipientRepository()->searchColumn($column, $value, $take);
    }

    public function getMessageRecipients(string $messageID, int $take = 10): array
    {
        return $this->messageGroupRecipientDatabaseDriver->messageGroupRecipientRepository()->getMessageRecipients($messageID, $take);
    }

    public function getMessageGroupRecipients(string $messageGroupID, int $take = 10): array
    {
        return $this->messageGroupRecipientDatabaseDriver->messageGroupRecipientRepository()->getMessageGroupRecipients($messageGroupID, $take);
    }
}