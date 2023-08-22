<?php

namespace Epush\Core\Operator\Infra\Database\Repository\Contract;

interface OperatorRepositoryContract
{
    public function all(int $take): array;

    public function get(string $operatorID): array;

    public function create(array $operator): array;

    public function update(string $operatorID, array $operator): array;

    public function delete(string $id): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}