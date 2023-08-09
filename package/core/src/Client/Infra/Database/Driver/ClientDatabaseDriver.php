<?php

namespace Epush\Core\Client\Infra\Database\Driver;

use Epush\Core\Client\Infra\Database\Repository\Contract\ClientRepositoryContract;

class ClientDatabaseDriver implements ClientDatabaseDriverContract
{
    public function __construct(

        private ClientRepositoryContract $clientRepository

    ) {}

    public function clientRepository(): ClientRepositoryContract
    {
        return $this->clientRepository;
    }
}