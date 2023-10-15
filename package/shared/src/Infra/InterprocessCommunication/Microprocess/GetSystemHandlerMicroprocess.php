<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Orchi\App\Contract\OrchiDatabaseServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class GetSystemHandlerMicroprocess implements MicroprocessContract
{
    public function __construct(

        private OrchiDatabaseServiceContract $orchiService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$handlerID] = $data;
        return $this->orchiService->getHandler($handlerID);
    }
}