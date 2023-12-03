<?php

namespace Epush\Core\MessageRecipient\App\Service;

use Epush\Core\MessageRecipient\App\Contract\MessageRecipientDatabaseServiceContract;
use Epush\Core\MessageRecipient\Infra\Database\Driver\MessageRecipientDatabaseDriverContract;

class MessageRecipientDatabaseService implements MessageRecipientDatabaseServiceContract
{
    public function __construct(

        private MessageRecipientDatabaseDriverContract $messageRecipientDatabaseDriver

    ) {}

    public function paginateMessageRecipients(int $take): array
    {
        return $this->messageRecipientDatabaseDriver->messageRecipientRepository()->all($take);
    }

    public function addMessageRecipients(string $messageID, array $messageGroupRecipientIDs, $status = 'Initialized'): array
    {
        return $this->messageRecipientDatabaseDriver->messageRecipientRepository()->insert($messageID, $messageGroupRecipientIDs, $status);
    }

    public function updateMessageRecipients(string $messageID, array $data): array
    {
        return $this->messageRecipientDatabaseDriver->messageRecipientRepository()->update($messageID, $data);
    }

    public function deleteMessageRecipients(string $messageID): bool
    {
        return $this->messageRecipientDatabaseDriver->messageRecipientRepository()->delete($messageID);
    }

    public function searchMessageRecipientColumn(string $column, string $value, int $take = 10): array
    {
        return $this->messageRecipientDatabaseDriver->messageRecipientRepository()->searchColumn($column, $value, $take);
    }
}