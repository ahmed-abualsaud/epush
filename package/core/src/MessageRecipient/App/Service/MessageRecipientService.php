<?php

namespace Epush\Core\MessageRecipient\App\Service;


use Epush\Core\MessageRecipient\App\Contract\MessageRecipientServiceContract;
use Epush\Core\MessageRecipient\App\Contract\MessageRecipientDatabaseServiceContract;

class MessageRecipientService implements MessageRecipientServiceContract
{
    public function __construct(

        private MessageRecipientDatabaseServiceContract $messageRecipientDatabaseService

    ) {}


    public function list(int $take): array
    {
        return $this->messageRecipientDatabaseService->paginateMessageRecipients($take);
    }

    public function add(string $messageID, array $messageGroupRecipientIDs): array
    {
        return $this->messageRecipientDatabaseService->addMessageRecipients($messageID, $messageGroupRecipientIDs);
    }

    public function delete(string $messageID): bool
    {
        return $this->messageRecipientDatabaseService->deleteMessageRecipients($messageID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return $this->messageRecipientDatabaseService->searchMessageRecipientColumn($column, $value, $take);
    }
}