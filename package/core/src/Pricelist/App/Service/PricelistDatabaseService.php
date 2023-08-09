<?php

namespace Epush\Core\Pricelist\App\Service;

use Epush\Core\Pricelist\App\Contract\PricelistDatabaseServiceContract;
use Epush\Core\Pricelist\Infra\Database\Driver\PricelistDatabaseDriverContract;

class PricelistDatabaseService implements PricelistDatabaseServiceContract
{
    public function __construct(

        private PricelistDatabaseDriverContract $pricelistDatabaseDriver

    ) {}

    public function listPricelists(): array
    {
        return $this->pricelistDatabaseDriver->pricelistRepository()->all();
    }

    public function getPricelist(string $pricelistID): array
    {
        return $this->pricelistDatabaseDriver->pricelistRepository()->get($pricelistID);
    }

    public function addPricelist(array $pricelist): array
    {
        return $this->pricelistDatabaseDriver->pricelistRepository()->create($pricelist);
    }

    public function updatePricelist(string $pricelistID, array $data): array
    {
        return $this->pricelistDatabaseDriver->pricelistRepository()->update($pricelistID, $data);
    }

    public function deletePricelist(string $pricelistID): bool
    {
        return $this->pricelistDatabaseDriver->pricelistRepository()->delete($pricelistID);
    }
}