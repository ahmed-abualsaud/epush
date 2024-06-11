<?php

namespace Epush\Core\Client\App\Contract;

interface ClientDatabaseServiceContract
{
    public function getClient(string $userID): array;

    public function getClients(array $usersID, int $partnerID = null): array;

    public function addClient(array $client): array;

    public function deleteClient(string $userID): bool;

    public function updateClient(string $userID, array $client): array;

    public function updateClientWallet(string $userID, float $cost, string $action): array;

    public function paginateClients(int $take, int $partnerID = null): array;

    public function getClientsBySalesID(array $salesID): array;

    public function addClientWebsites(string $clientID, array $websites): array;

    public function updateClientWebsites(string $clientID, array $newWebsites, bool $sync = false): array;

    public function searchClientColumn(string $column, string $value, int $take = 10, int $partnerID = null): array;
}