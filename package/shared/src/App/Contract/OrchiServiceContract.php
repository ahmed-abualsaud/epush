<?php

namespace Epush\Shared\App\Contract;

interface OrchiServiceContract
{
    public function getHandlers(array $handlersID): array;
}