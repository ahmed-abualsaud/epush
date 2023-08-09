<?php

namespace Epush\Core\Client\Infra\Database\Driver;

use Epush\Core\Client\Infra\Database\Repository\Contract\ClientRepositoryContract;

interface ClientDatabaseDriverContract
{
    public function clientRepository(): ClientRepositoryContract;
}