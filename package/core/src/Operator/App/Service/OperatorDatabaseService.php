<?php

namespace Epush\Core\Operator\App\Service;

use Epush\Core\Operator\App\Contract\OperatorDatabaseServiceContract;
use Epush\Core\Operator\Infra\Database\Driver\OperatorDatabaseDriverContract;

class OperatorDatabaseService implements OperatorDatabaseServiceContract
{
    public function __construct(

        private OperatorDatabaseDriverContract $operatorDatabaseDriver

    ) {}

    public function getOperator(string $operatorID): array
    {
        return $this->operatorDatabaseDriver->operatorRepository()->get($operatorID);
    }

    public function paginateOperators(int $take): array
    {
        return $this->operatorDatabaseDriver->operatorRepository()->all($take);
    }

    public function addOperator(array $operator): array
    {
        return $this->operatorDatabaseDriver->operatorRepository()->create($operator);
    }

    public function updateOperator(string $operatorID, array $operator): array
    {
        return $this->operatorDatabaseDriver->operatorRepository()->update($operatorID, $operator);
    }

    public function deleteOperator(string $operatorID): bool
    {
        return $this->operatorDatabaseDriver->operatorRepository()->delete($operatorID);
    }

    public function searchOperatorColumn(string $column, string $value, int $take = 10): array
    {
        return $this->operatorDatabaseDriver->operatorRepository()->searchColumn($column, $value, $take);
    }
}