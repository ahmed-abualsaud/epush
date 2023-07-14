<?php

namespace Epush\Shared\App\Contract;

interface ScanningServiceContract
{
    public function scanModules(string $modulesDirectory, string $contextsDirectory): array;
}