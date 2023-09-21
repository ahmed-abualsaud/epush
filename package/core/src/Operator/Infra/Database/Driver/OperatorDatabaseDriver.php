<?php

namespace Epush\Core\Operator\Infra\Database\Driver;

use Epush\Core\Operator\Infra\Database\Repository\Contract\OperatorRepositoryContract;

class OperatorDatabaseDriver implements OperatorDatabaseDriverContract
{
    public function __construct(

        private OperatorRepositoryContract $operatorRepository

    ) {}

    public function operatorRepository(): OperatorRepositoryContract
    {
        return $this->operatorRepository;
    }
}