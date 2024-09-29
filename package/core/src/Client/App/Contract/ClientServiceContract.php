<?php

namespace Epush\Core\Client\App\Contract;

interface ClientServiceContract
{
    public function list(int $take, int $partnerID = null): array;

    public function get(string $userID): array;

    public function add(array $client, array $user): array;

    public function update(string $userID, array $client, array $user): array;

    public function updateWallet(string $userID, float $cost, string $action): array;

    public function delete(string $userID): bool;

    public function getClients(array $usersID, int $partnerID = null): array;

    public function getClientsBySalesID(array $salesID): array;

    public function getClientMessages(string $userID, int $take = null): array;

    public function getClientMessageGroups(string $userID): array;

    public function getClientSenders(string $userID): array;

    public function getClientOrders(string $userID): array;

    public function getClientLatestOrder(string $userID): array;

    public function getClientIPWhitelist(string $userID): array;

    public function addClientWebsites(string $clientID, array $websites): array;

    public function searchColumn(string $column, string $value, bool $searchClient = true, int $take = 10, int $partnerID = null): array;
}