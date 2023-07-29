<?php

namespace Epush\Core\Infra\Database\Driver;

use Epush\Core\Infra\Database\Repository\Contract\ClientRepositoryContract;

interface CoreDatabaseDriverContract
{
    public function clientRepository(): ClientRepositoryContract;
}