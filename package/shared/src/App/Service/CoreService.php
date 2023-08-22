<?php


namespace Epush\Shared\App\Service;

use Epush\Shared\App\Contract\CoreServiceContract;


use Epush\Core\Sales\App\Contract\SalesServiceContract;
use Epush\Core\Client\App\Contract\ClientServiceContract;
use Epush\Core\Pricelist\App\Contract\PricelistServiceContract;

class CoreService implements CoreServiceContract
{
    public function __construct(

        private SalesServiceContract $salesService,
        private ClientServiceContract $clientService,
        private PricelistServiceContract $pricelistService

    ) {}

    public function getClient(string $userID): array
    {
        return $this->clientService->get($userID);
    }

    public function getClients(array $usersID): array
    {
        return $this->clientService->getClients($usersID);
    }

    public function addClient(array $client,  array $user): array
    {
        return $this->clientService->add($client, $user);
    }

    public function updateClientWallet(string $userID, float $cost, string $action): array
    {
        return $this->clientService->updateWallet($userID, $cost, $action);
    }

    public function getClientsBySalesID(array $salesID): array
    {
        return $this->clientService->getClientsBySalesID($salesID);
    }

    public function searchClientColumn(string $column, string $value, int $take = 10): array
    {
        return $this->clientService->searchColumn($column, $value, true, $take);
    }

    public function addClientWebsites(string $clientID, array $websites): array
    {
        return $this->clientService->addClientWebsites($clientID, $websites);
    }


    public function getPricelist(string $pricelistID): array
    {
        return $this->pricelistService->get($pricelistID);
    }

    public function getPricelists(array $pricelistsID): array
    {
        return $this->pricelistService->getPricelists($pricelistsID);
    }

    public function searchSalesColumn(string $column, string $value, int $take = 10): array
    {
        return $this->salesService->searchColumn($column, $value, $take);
    }

    public function searchPricelistColumn(string $column, string $value, int $take = 10): array
    {
        return $this->pricelistService->searchColumn($column, $value, $take);
    }
}