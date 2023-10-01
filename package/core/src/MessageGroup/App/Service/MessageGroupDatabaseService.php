<?php

namespace Epush\Core\MessageGroup\App\Service;

use Epush\Core\MessageGroup\App\Contract\MessageGroupDatabaseServiceContract;
use Epush\Core\MessageGroup\Infra\Database\Driver\MessageGroupDatabaseDriverContract;

class MessageGroupDatabaseService implements MessageGroupDatabaseServiceContract
{
    public function __construct(

        private MessageGroupDatabaseDriverContract $messageGroupDatabaseDriver

    ) {}

    public function getMessageGroup(string $messageGroupID): array
    {
        return $this->messageGroupDatabaseDriver->messageGroupRepository()->get($messageGroupID);
    }

    public function paginateMessageGroups(int $take): array
    {
        return $this->messageGroupDatabaseDriver->messageGroupRepository()->all($take);
    }

    public function addMessageGroup(array $messageGroup): array
    {
        return $this->messageGroupDatabaseDriver->messageGroupRepository()->create($messageGroup);
    }

    public function updateMessageGroup(string $messageGroupID, array $messageGroup): array
    {
        return $this->messageGroupDatabaseDriver->messageGroupRepository()->update($messageGroupID, $messageGroup);
    }

    public function deleteMessageGroup(string $messageGroupID): bool
    {
        return $this->messageGroupDatabaseDriver->messageGroupRepository()->delete($messageGroupID);
    }

    public function searchMessageGroupColumn(string $column, string $value, int $take = 10): array
    {
        return $this->messageGroupDatabaseDriver->messageGroupRepository()->searchColumn($column, $value, $take);
    }
}