<?php

namespace Epush\Core\Sales\Infra\Database\Driver;

use Epush\Core\Sales\Infra\Database\Repository\Contract\SalesRepositoryContract;

class SalesDatabaseDriver implements SalesDatabaseDriverContract
{
    public function __construct(

        private SalesRepositoryContract $salesRepository

    ) {}

    public function salesRepository(): SalesRepositoryContract
    {
        return $this->salesRepository;
    }
}