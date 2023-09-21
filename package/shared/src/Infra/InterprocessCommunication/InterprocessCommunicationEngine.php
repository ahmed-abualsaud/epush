<?php

namespace Epush\Shared\Infra\InterprocessCommunication;

use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class InterprocessCommunicationEngine implements InterprocessCommunicationEngineContract
{
    private $microprocesses = [];

    public function __construct()
    {
        // A special event group for microprocesses that want to listen to all events.
        $this->microprocesses["*"] = [];
    }

    private function initEventGroup(string $event = "*"): void
    {
        if (!isset($this->microprocesses[$event])) {
            $this->microprocesses[$event] = [];
        }
    }

    private function getEventMicroprocesses(string $event = "*"): array
    {
        $this->initEventGroup($event);
        $group = $this->microprocesses[$event];
        $all = $this->microprocesses["*"];

        return array_merge($group, $all);
    }

    public function attach(MicroprocessContract $microprocess, string $event = "*"): void
    {
        $this->initEventGroup($event);

        $this->microprocesses[$event][] = $microprocess;
    }

    public function detach(MicroprocessContract $microprocess, string $event = "*"): void
    {
        foreach ($this->getEventMicroprocesses($event) as $key => $s) {
            if ($s === $microprocess) {
                unset($this->microprocesses[$event][$key]);
            }
        }
    }

    public function broadcast(string $event = "*", mixed ...$data): mixed
    {
        $result = [];
    
        foreach ($this->getEventMicroprocesses($event) as $microprocess) {
            $result[] = $microprocess->listen($this, $event, ...$data);
        }

        return $result;
    }
}