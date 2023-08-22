<?php

namespace Epush\Core\Sales\App\Contract;

interface SalesServiceContract
{
    public function list(): array;

    public function get(string $salesID): array;

    public function add(array $sales): array;

    public function update(string $salesID, array $data): array;

    public function delete(string $salesID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}