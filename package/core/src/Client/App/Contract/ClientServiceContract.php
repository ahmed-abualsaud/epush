<?php

namespace Epush\Core\Client\App\Contract;

interface ClientServiceContract
{
    public function list(int $take): array;

    public function get(string $userID): array;

    public function add(array $client, array $user): array;

    public function update(string $userID, array $client, array $user): array;

    public function updateWallet(string $userID, float $cost, string $action): array;

    public function delete(string $userID): bool;

    public function getClients(array $usersID): array;

    public function getClientsBySalesID(array $salesID): array;

    public function getClientOrders(string $userID): array;

    public function addClientWebsites(string $clientID, array $websites): array;

    public function searchColumn(string $column, string $value, bool $searchClient = true, int $take = 10): array;
}