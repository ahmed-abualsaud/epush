<?php

namespace Epush\Core\Sales\App\Service;

use Epush\Core\Sales\App\Contract\SalesDatabaseServiceContract;
use Epush\Core\Sales\Infra\Database\Driver\SalesDatabaseDriverContract;

class SalesDatabaseService implements SalesDatabaseServiceContract
{
    public function __construct(

        private SalesDatabaseDriverContract $salesDatabaseDriver

    ) {}

    public function listSales(): array
    {
        return $this->salesDatabaseDriver->salesRepository()->all();
    }

    public function getSales(string $salesID): array
    {
        return $this->salesDatabaseDriver->salesRepository()->get($salesID);
    }

    public function addSales(array $sales): array
    {
        return $this->salesDatabaseDriver->salesRepository()->create($sales);
    }

    public function updateSales(string $salesID, array $data): array
    {
        return $this->salesDatabaseDriver->salesRepository()->update($salesID, $data);
    }

    public function deleteSales(string $salesID): bool
    {
        return $this->salesDatabaseDriver->salesRepository()->delete($salesID);
    }

    public function searchSalesColumn(string $column, string $value, int $take = 10): array
    {
        return $this->salesDatabaseDriver->salesRepository()->searchColumn($column, $value, $take);
    }
}