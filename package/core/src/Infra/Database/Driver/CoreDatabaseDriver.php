<?php

namespace Epush\Core\Infra\Database\Driver;

use Epush\Core\Infra\Database\Repository\Contract\ClientRepositoryContract;

class CoreDatabaseDriver implements CoreDatabaseDriverContract
{
    public function __construct(

        private ClientRepositoryContract $clientRepository

    ) {}

    public function clientRepository(): ClientRepositoryContract
    {
        return $this->clientRepository;
    }
}