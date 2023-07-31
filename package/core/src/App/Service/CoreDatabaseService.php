<?php

namespace Epush\Core\App\Service;

use Epush\Core\App\Contract\CoreDatabaseServiceContract;
use Epush\Core\Infra\Database\Driver\CoreDatabaseDriverContract;

class CoreDatabaseService implements CoreDatabaseServiceContract
{
    public function __construct(

        private CoreDatabaseDriverContract $coreDatabaseDriver

    ) {}

    public function getClient(string $userID): array
    {
        return $this->coreDatabaseDriver->clientRepository()->get($userID);
    }

    public function addClient(array $client): array
    {
        return $this->coreDatabaseDriver->clientRepository()->create($client);
    }

    public function addClientWebsites(string $clientID, array $websites): array
    {
        return $this->coreDatabaseDriver->clientRepository()->addClientWebsites($clientID, $websites);
    }
}