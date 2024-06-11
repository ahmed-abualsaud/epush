<?php

namespace Epush\Core\Client\Infra\Database\Repository\Contract;

interface ClientRepositoryContract
{
    public function all(int $take, int $partnerID = null): array;

    public function get(string $userID): array;

    public function create(array $client): array;

    public function update(string $userID, array $client): array;

    public function updateWallet(string $userID, float $cost, string $action): array;

    public function delete(string $id): bool;

    public function getClients(array $usersID, int $partnerID = null): array;

    public function getClientsBySalesID(array $salesID): array;

    public function addClientWebsites(string $clientID, array $websites): array;

    public function updateClientWebsites(string $clientID, array $newWebsites, bool $sync = false): array;

    public function searchColumn(string $column, string $value, int $take = 10, int $partnerID = null): array;
}