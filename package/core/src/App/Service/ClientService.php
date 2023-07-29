<?php

namespace Epush\Core\App\Service;

use Epush\Core\App\Contract\ClientServiceContract;
use Epush\Core\App\Contract\CoreDatabaseServiceContract;
use Epush\Shared\App\Contract\AuthServiceContract;

class ClientService implements ClientServiceContract
{
    public function __construct(

        private AuthServiceContract $authService,
        private CoreDatabaseServiceContract $coreDatabaseService

    ) {}

    public function get(string $clientID): array
    {
        $client = $this->coreDatabaseService->getClient($clientID);
        $user = $this->authService->getUser($client['id']);
        return array_merge_recursive($user, $client);
    }

    public function addClient(array $client): array
    {
        return $this->coreDatabaseService->addClient($client);
    }

    public function addClientWebsites(string $clientID, array $websites): array
    {
        return $this->coreDatabaseService->addClientWebsites($clientID, $websites);
    }
}