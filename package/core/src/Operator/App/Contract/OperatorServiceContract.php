<?php

namespace Epush\Core\Operator\App\Contract;

interface OperatorServiceContract
{
    public function list(int $take): array;

    public function get(string $operatorID): array;

    public function add(array $operator): array;

    public function update(string $operatorID, array $operator): array;

    public function delete(string $operatorID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}