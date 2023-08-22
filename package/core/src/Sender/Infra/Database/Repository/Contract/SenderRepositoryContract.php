<?php

namespace Epush\Core\Sender\Infra\Database\Repository\Contract;

interface SenderRepositoryContract
{
    public function all(int $take): array;

    public function get(string $senderID): array;

    public function getClientSenders(string $userID): array;

    public function getSendersByID(array $sendersID): array;

    public function create(array $sender): array;

    public function update(string $senderID, array $sender): array;

    public function delete(string $id): bool;

    public function getSendersByUsersID(array $usersID, int $take = 10): array;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}