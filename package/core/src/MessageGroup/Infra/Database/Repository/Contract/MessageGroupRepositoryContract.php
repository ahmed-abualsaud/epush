<?php

namespace Epush\Core\MessageGroup\Infra\Database\Repository\Contract;

interface MessageGroupRepositoryContract
{
    public function all(int $take): array;

    public function get(string $messageGroupID): array;

    public function create(array $messageGroup): array;

    public function update(string $messageGroupID, array $messageGroup): array;

    public function delete(string $id): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;

    public function getMessageGroupsByUsersID(array $usersID, int $take): array;

    public function getClientMessageGroups(string $userID): array;

}