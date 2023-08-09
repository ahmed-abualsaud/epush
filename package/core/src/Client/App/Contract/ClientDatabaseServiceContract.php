<?php

namespace Epush\Core\Client\App\Contract;

interface ClientDatabaseServiceContract
{
    public function getClient(string $userID): array;

    public function getClients(array $usersID): array;

    public function addClient(array $client): array;

    public function deleteClient(string $userID): bool;

    public function updateClient(string $userID, array $client): array;

    public function paginateClients(int $take): array;

    public function addClientWebsites(string $clientID, array $websites): array;

    public function updateClientWebsites(string $clientID, array $newWebsites, bool $sync = false): array;

    public function searchClientColumn(string $column, string $value, int $take = 10): array;
}