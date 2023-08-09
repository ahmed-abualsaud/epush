<?php

namespace Epush\Core\Pricelist\Infra\Database\Driver;

use Epush\Core\Pricelist\Infra\Database\Repository\Contract\PricelistRepositoryContract;

class PricelistDatabaseDriver implements PricelistDatabaseDriverContract
{
    public function __construct(

        private PricelistRepositoryContract $pricelistRepository

    ) {}

    public function pricelistRepository(): PricelistRepositoryContract
    {
        return $this->pricelistRepository;
    }
}