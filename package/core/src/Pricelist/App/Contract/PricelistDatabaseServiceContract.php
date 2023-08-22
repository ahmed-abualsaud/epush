<?php

namespace Epush\Core\Pricelist\App\Contract;

interface PricelistDatabaseServiceContract
{
    public function listPricelists(): array;

    public function getPricelist(string $pricelistID): array;

    public function addPricelist(array $pricelist): array;

    public function updatePricelist(string $pricelistID, array $data): array;

    public function deletePricelist(string $pricelistID): bool;

    public function getPricelists(array $pricelistsID): array;

    public function searchPricelistColumn(string $column, string $value, int $take = 10): array;
}