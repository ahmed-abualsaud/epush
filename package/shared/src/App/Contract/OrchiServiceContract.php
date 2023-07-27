<?php

namespace Epush\Shared\App\Contract;

interface OrchiServiceContract
{
    public function getHandlers(array $handlersID): array;

    public function getHandlerByEndpoint(string $endpoint): array;
}