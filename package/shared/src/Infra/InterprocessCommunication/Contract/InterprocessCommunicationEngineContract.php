<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Contract;


interface InterprocessCommunicationEngineContract
{
    public function attach(MicroprocessContract $microprocess, string $event = "*"): void;

    public function detach(MicroprocessContract $microprocess, string $event = "*"): void;

    public function broadcast(string $event = "*", mixed ...$data): mixed;
}