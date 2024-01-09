<?php

namespace Epush\Core\MessageGroupRecipient\App\Service;


use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientServiceContract;
use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientDatabaseServiceContract;

class MessageGroupRecipientService implements MessageGroupRecipientServiceContract
{
    public function __construct(

        private MessageGroupRecipientDatabaseServiceContract $messageGroupRecipientDatabaseService

    ) {}


    public function list(int $take): array
    {
        return $this->messageGroupRecipientDatabaseService->paginateMessageGroupRecipients($take);
    }

    public function get(string $messageGroupRecipientID): array
    {
        return $this->messageGroupRecipientDatabaseService->getMessageGroupRecipient($messageGroupRecipientID);
    }

    public function add(string $groupID, array $messageGroupRecipients): array
    {
        return $this->messageGroupRecipientDatabaseService->addMessageGroupRecipients($groupID, $messageGroupRecipients);
    }

    public function update(string $messageGroupRecipientID, array $messageGroupRecipient): array
    {
        return $this->messageGroupRecipientDatabaseService->updateMessageGroupRecipient($messageGroupRecipientID, $messageGroupRecipient);
    }

    public function delete(string $messageGroupRecipientID): bool
    {
        return $this->messageGroupRecipientDatabaseService->deleteMessageGroupRecipient($messageGroupRecipientID);
    }

    public function deleteMessageGroupRecipients(string $groupID): bool
    {
        return $this->messageGroupRecipientDatabaseService->deleteMessageGroupRecipients($groupID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return $this->messageGroupRecipientDatabaseService->searchMessageGroupRecipientColumn($column, $value, $take);
    }

    public function getMessageRecipients(string $messageID, int $take = 10): array
    {
        return $this->messageGroupRecipientDatabaseService->getMessageRecipients($messageID, $take);
    }

    public function getMessageGroupRecipients(string $messageGroupID, int $take = 10): array
    {
        return $this->messageGroupRecipientDatabaseService->getMessageGroupRecipients($messageGroupID, $take);
    }
}