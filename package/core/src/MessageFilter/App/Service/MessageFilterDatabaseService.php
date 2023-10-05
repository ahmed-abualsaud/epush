<?php

namespace Epush\Core\MessageFilter\App\Service;

use Epush\Core\MessageFilter\App\Contract\MessageFilterDatabaseServiceContract;
use Epush\Core\MessageFilter\Infra\Database\Driver\MessageFilterDatabaseDriverContract;

class MessageFilterDatabaseService implements MessageFilterDatabaseServiceContract
{
    public function __construct(

        private MessageFilterDatabaseDriverContract $messageFilterDatabaseDriver

    ) {}

    public function getMessageFilter(string $messageFilterID): array
    {
        return $this->messageFilterDatabaseDriver->messageFilterRepository()->get($messageFilterID);
    }

    public function paginateMessageFilters(int $take): array
    {
        return $this->messageFilterDatabaseDriver->messageFilterRepository()->all($take);
    }

    public function addMessageFilter(array $messageFilter): array
    {
        return $this->messageFilterDatabaseDriver->messageFilterRepository()->create($messageFilter);
    }

    public function updateMessageFilter(string $messageFilterID, array $messageFilter): array
    {
        return $this->messageFilterDatabaseDriver->messageFilterRepository()->update($messageFilterID, $messageFilter);
    }

    public function deleteMessageFilter(string $messageFilterID): bool
    {
        return $this->messageFilterDatabaseDriver->messageFilterRepository()->delete($messageFilterID);
    }

    public function searchMessageFilterColumn(string $column, string $value, int $take = 10): array
    {
        return $this->messageFilterDatabaseDriver->messageFilterRepository()->searchColumn($column, $value, $take);
    }
}