<?php

namespace Epush\Core\MessageFilter\App\Contract;

interface MessageFilterDatabaseServiceContract
{
    public function getMessageFilter(string $messageFilterID): array;

    public function addMessageFilter(array $messageFilter): array;

    public function deleteMessageFilter(string $messageFilterID): bool;

    public function updateMessageFilter(string $messageFilterID, array $messageFilter): array;

    public function paginateMessageFilters(int $take): array;

    public function searchMessageFilterColumn(string $column, string $value, int $take = 10): array;
}