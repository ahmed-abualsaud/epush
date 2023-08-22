<?php

namespace Epush\Shared\App\Contract;

interface CoreServiceContract
{
    public function getClient(string $userID): array;

    public function getClients(array $usersID): array;

    public function addClient(array $client,  array $user): array;

    public function updateClientWallet(string $userID, float $cost, string $action): array;

    public function getClientsBySalesID(array $salesID): array;

    public function searchClientColumn(string $column, string $value, int $take = 10): array;

    public function addClientWebsites(string $clientID, array $websites): array;

    public function getPricelist(string $pricelistID): array;

    public function getPricelists(array $pricelistsID): array;

    public function searchSalesColumn(string $column, string $value, int $take = 10): array;

    public function searchPricelistColumn(string $column, string $value, int $take = 10): array;
}