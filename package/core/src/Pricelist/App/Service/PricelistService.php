<?php

namespace Epush\Core\Pricelist\App\Service;

use Epush\Core\Pricelist\App\Contract\PricelistServiceContract;
use Epush\Core\Pricelist\App\Contract\PricelistDatabaseServiceContract;

class PricelistService implements PricelistServiceContract
{
    public function __construct(

        private PricelistDatabaseServiceContract $pricelistDatabaseService

    ) {}

    public function list(): array
    {
        return $this->pricelistDatabaseService->listPricelists();
    }

    public function get(string $pricelistID): array
    {
        return $this->pricelistDatabaseService->getPricelist($pricelistID);
    }

    public function add(array $pricelist): array
    {
        return $this->pricelistDatabaseService->addPricelist($pricelist);
    }

    public function update(string $pricelistID, array $data): array
    {
        return $this->pricelistDatabaseService->updatePricelist($pricelistID, $data);
    }

    public function delete(string $pricelistID): bool
    {
        return $this->pricelistDatabaseService->deletePricelist($pricelistID);
    }

    public function getPricelists(array $pricelistsID): array
    {
        return $this->pricelistDatabaseService->getPricelists($pricelistsID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return $this->pricelistDatabaseService->searchPricelistColumn($column, $value, $take);
    }
}