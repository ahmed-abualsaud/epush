<?php

namespace Epush\Core\MessageGroup\App\Service;


use Epush\Core\MessageGroup\App\Contract\MessageGroupServiceContract;
use Epush\Core\MessageGroup\App\Contract\MessageGroupDatabaseServiceContract;
use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientServiceContract;

class MessageGroupService implements MessageGroupServiceContract
{
    public function __construct(

        private MessageGroupDatabaseServiceContract $messageGroupDatabaseService,
        private MessageGroupRecipientServiceContract $messageGroupRecipientService

    ) {}


    public function list(int $take): array
    {
        return $this->messageGroupDatabaseService->paginateMessageGroups($take);
    }

    public function get(string $messageGroupID): array
    {
        return $this->messageGroupDatabaseService->getMessageGroup($messageGroupID);
    }

    public function add(array $messageGroup, array $messageGroupRecipients): array
    {
        $group = $this->messageGroupDatabaseService->addMessageGroup($messageGroup);
        return $this->messageGroupRecipientService->add($group['id'], $messageGroupRecipients);
    }

    public function update(string $messageGroupID, array $messageGroup): array
    {
        return $this->messageGroupDatabaseService->updateMessageGroup($messageGroupID, $messageGroup);
    }

    public function delete(string $messageGroupID): bool
    {
        return $this->messageGroupDatabaseService->deleteMessageGroup($messageGroupID) && 
               $this->messageGroupRecipientService->deleteMessageGroupRecipients($messageGroupID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return $this->messageGroupDatabaseService->searchMessageGroupColumn($column, $value, $take);
    }
}