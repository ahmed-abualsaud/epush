<?php

namespace Epush\Orchi\App\Contract;

interface LookupServiceContract
{
    public function servicesLookup(array $remoteAppServices): array;
}