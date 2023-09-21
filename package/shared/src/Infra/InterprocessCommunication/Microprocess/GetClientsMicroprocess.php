<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Core\Client\App\Contract\ClientServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class GetClientsMicroprocess implements MicroprocessContract
{
    public function __construct(

        private ClientServiceContract $clientService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$usersID] = $data;
        return $this->clientService->getClients($usersID);
    }
}