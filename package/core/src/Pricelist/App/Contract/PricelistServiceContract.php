<?php

namespace Epush\Core\Pricelist\App\Contract;

interface PricelistServiceContract
{
    public function list(): array;

    public function get(string $pricelistID): array;

    public function add(array $pricelist): array;

    public function update(string $pricelistID, array $data): array;

    public function delete(string $pricelistID): bool;

    public function getPricelists(array $pricelistsID): array;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}