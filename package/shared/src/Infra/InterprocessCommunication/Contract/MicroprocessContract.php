<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Contract;


interface MicroprocessContract
{
    public function listen(InterprocessCommunicationEngineContract $interprocessCommunicationEngine, string $event = null, mixed ...$data): mixed;
}