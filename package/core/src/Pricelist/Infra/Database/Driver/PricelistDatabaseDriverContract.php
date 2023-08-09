<?php

namespace Epush\Core\Pricelist\Infra\Database\Driver;

use Epush\Core\Pricelist\Infra\Database\Repository\Contract\PricelistRepositoryContract;

interface PricelistDatabaseDriverContract
{
    public function pricelistRepository(): PricelistRepositoryContract;
}