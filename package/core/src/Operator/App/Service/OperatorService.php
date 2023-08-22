<?php

namespace Epush\Core\Operator\App\Service;


use Epush\Core\Operator\App\Contract\OperatorServiceContract;
use Epush\Core\Operator\App\Contract\OperatorDatabaseServiceContract;

class OperatorService implements OperatorServiceContract
{
    public function __construct(

        private OperatorDatabaseServiceContract $operatorDatabaseService

    ) {}


    public function list(int $take): array
    {
        return $this->operatorDatabaseService->paginateOperators($take);
    }

    public function get(string $operatorID): array
    {
        return $this->operatorDatabaseService->getOperator($operatorID);
    }

    public function add(array $operator): array
    {
        return $this->operatorDatabaseService->addOperator($operator);
    }

    public function update(string $operatorID, array $operator): array
    {
        return $this->operatorDatabaseService->updateOperator($operatorID, $operator);
    }

    public function delete(string $operatorID): bool
    {
        return $this->operatorDatabaseService->deleteOperator($operatorID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return $this->operatorDatabaseService->searchOperatorColumn($column, $value, $take);
    }
}