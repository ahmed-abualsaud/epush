<?php

namespace Epush\Core\Operator\App\Contract;

interface OperatorDatabaseServiceContract
{
    public function getOperator(string $operatorID): array;

    public function addOperator(array $operator): array;

    public function deleteOperator(string $operatorID): bool;

    public function updateOperator(string $operatorID, array $operator): array;

    public function paginateOperators(int $take): array;

    public function searchOperatorColumn(string $column, string $value, int $take = 10): array;
}