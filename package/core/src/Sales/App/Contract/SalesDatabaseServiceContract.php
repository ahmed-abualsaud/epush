<?php

namespace Epush\Core\Sales\App\Contract;

interface SalesDatabaseServiceContract
{
    public function listSales(): array;

    public function getSales(string $salesID): array;

    public function addSales(array $sales): array;

    public function updateSales(string $salesID, array $data): array;

    public function deleteSales(string $salesID): bool;

    public function searchSalesColumn(string $column, string $value, int $take = 10): array;
}