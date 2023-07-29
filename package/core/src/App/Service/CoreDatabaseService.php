<?php

namespace Epush\Core\App\Service;

use Epush\Core\App\Contract\CoreDatabaseServiceContract;
use Epush\Core\Infra\Database\Driver\CoreDatabaseDriverContract;

class CoreDatabaseService implements CoreDatabaseServiceContract
{
    public function __construct(

        private CoreDatabaseDriverContract $coreDatabaseDriver

    ) {}

    public function getClient(string $clientID): array
    {
        return $this->coreDatabaseDriver->clientRepository()->get($clientID);
    }

    public function addClient(array $client): array
    {
        return $this->coreDatabaseDriver->clientRepository()->add($client);
    }

    public function addClientWebsites(string $clientID, array $websites): array
    {
        return $this->coreDatabaseDriver->clientRepository()->addClientWebsites($clientID, $websites);
    }
}