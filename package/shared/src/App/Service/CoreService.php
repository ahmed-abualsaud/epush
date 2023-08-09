<?php


namespace Epush\Shared\App\Service;

use Epush\Core\Client\App\Contract\ClientServiceContract;
use Epush\Shared\App\Contract\CoreServiceContract;

class CoreService implements CoreServiceContract
{
    public function __construct(

        private ClientServiceContract $clientService

    ) {}

    public function addClient(array $client,  array $user): array
    {
        return $this->clientService->add($client, $user);
    }

    public function addClientWebsites(string $clientID, array $websites): array
    {
        return $this->clientService->addClientWebsites($clientID, $websites);
    }
}