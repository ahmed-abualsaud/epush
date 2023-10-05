<?php

namespace Epush\Core\MessageFilter\App\Service;


use Epush\Core\MessageFilter\App\Contract\MessageFilterServiceContract;
use Epush\Core\MessageFilter\App\Contract\MessageFilterDatabaseServiceContract;

class MessageFilterService implements MessageFilterServiceContract
{
    public function __construct(

        private MessageFilterDatabaseServiceContract $messageFilterDatabaseService

    ) {}


    public function list(int $take): array
    {
        return $this->messageFilterDatabaseService->paginateMessageFilters($take);
    }

    public function get(string $messageFilterID): array
    {
        return $this->messageFilterDatabaseService->getMessageFilter($messageFilterID);
    }

    public function add(array $messageFilter): array
    {
        return $this->messageFilterDatabaseService->addMessageFilter($messageFilter);
    }

    public function update(string $messageFilterID, array $messageFilter): array
    {
        return $this->messageFilterDatabaseService->updateMessageFilter($messageFilterID, $messageFilter);
    }

    public function delete(string $messageFilterID): bool
    {
        return $this->messageFilterDatabaseService->deleteMessageFilter($messageFilterID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return $this->messageFilterDatabaseService->searchMessageFilterColumn($column, $value, $take);
    }
}