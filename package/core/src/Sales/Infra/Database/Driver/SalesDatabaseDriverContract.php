<?php

namespace Epush\Core\Sales\Infra\Database\Driver;

use Epush\Core\Sales\Infra\Database\Repository\Contract\SalesRepositoryContract;

interface SalesDatabaseDriverContract
{
    public function salesRepository(): SalesRepositoryContract;
}