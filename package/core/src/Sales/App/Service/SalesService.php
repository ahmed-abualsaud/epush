<?php

namespace Epush\Core\Sales\App\Service;

use Epush\Core\Sales\App\Contract\SalesServiceContract;
use Epush\Core\Sales\App\Contract\SalesDatabaseServiceContract;

class SalesService implements SalesServiceContract
{
    public function __construct(

        private SalesDatabaseServiceContract $salesDatabaseService

    ) {}

    public function list(): array
    {
        return $this->salesDatabaseService->listSales();
    }

    public function get(string $salesID): array
    {
        return $this->salesDatabaseService->getSales($salesID);
    }

    public function add(array $sales): array
    {
        return $this->salesDatabaseService->addSales($sales);
    }

    public function update(string $salesID, array $data): array
    {
        return $this->salesDatabaseService->updateSales($salesID, $data);
    }

    public function delete(string $salesID): bool
    {
        return $this->salesDatabaseService->deleteSales($salesID);
    }
}