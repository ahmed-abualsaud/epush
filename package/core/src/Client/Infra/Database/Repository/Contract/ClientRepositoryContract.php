<?php

namespace Epush\Core\Client\Infra\Database\Repository\Contract;

interface ClientRepositoryContract
{
    public function all(int $take): array;

    public function get(string $userID): array;

    public function create(array $client): array;

    public function update(string $userID, array $client): array;

    public function delete(string $id): bool;

    public function getClients(array $usersID): array;

    public function addClientWebsites(string $clientID, array $websites): array;

    public function updateClientWebsites(string $clientID, array $newWebsites, bool $sync = false): array;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}