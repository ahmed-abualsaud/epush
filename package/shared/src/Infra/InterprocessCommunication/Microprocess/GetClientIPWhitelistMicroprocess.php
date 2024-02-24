<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Core\IPWhitelist\App\Contract\IPWhitelistServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;


class GetClientIPWhitelistMicroprocess implements MicroprocessContract
{
    public function __construct(

        private IPWhitelistServiceContract $ipWhitelistService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$userID] = $data;
        return $this->ipWhitelistService->getUserIPWhitelist($userID);
    }
}