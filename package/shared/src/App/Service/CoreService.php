<?php


namespace Epush\Shared\App\Service;

use Epush\Core\App\Contract\ClientServiceContract;
use Epush\Shared\App\Contract\CoreServiceContract;

class CoreService implements CoreServiceContract
{
    public function __construct(

        private ClientServiceContract $clientService

    ) {}

    public function addClient(array $client): array
    {
        return $this->clientService->addClient($client);
    }

    public function addClientWebsites(string $clientID, array $websites): array
    {
        return $this->clientService->addClientWebsites($clientID, $websites);
    }
}