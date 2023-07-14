<?php

namespace Epush\Orchi\App\Contract;

interface MonitoringServiceContract
{
    public function sync(): void;
}