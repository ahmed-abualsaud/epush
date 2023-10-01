<?php

namespace Epush\Core\MessageGroup\App\Contract;

interface MessageGroupDatabaseServiceContract
{
    public function getMessageGroup(string $messageGroupID): array;

    public function addMessageGroup(array $messageGroup): array;

    public function deleteMessageGroup(string $messageGroupID): bool;

    public function updateMessageGroup(string $messageGroupID, array $messageGroup): array;

    public function paginateMessageGroups(int $take): array;

    public function searchMessageGroupColumn(string $column, string $value, int $take = 10): array;
}