<?php

namespace Epush\Core\Operator\Infra\Database\Driver;

use Epush\Core\Operator\Infra\Database\Repository\Contract\OperatorRepositoryContract;

interface OperatorDatabaseDriverContract
{
    public function operatorRepository(): OperatorRepositoryContract;
}