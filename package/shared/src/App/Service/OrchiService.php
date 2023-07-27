<?php

namespace Epush\Shared\App\Service;

use Epush\Shared\App\Contract\OrchiServiceContract;
use Epush\Orchi\App\Contract\OrchiDatabaseServiceContract;

class OrchiService implements OrchiServiceContract
{
    public function __construct(

        private OrchiDatabaseServiceContract $orchiDatabaseService

    ) {}

    public function getHandlers(array $handlersID): array
    {
        return $this->orchiDatabaseService->getHandlers($handlersID);
    }

    public function getHandlerByEndpoint(string $endpoint): array
    {
        return $this->orchiDatabaseService->getHandlerByEndpoint($endpoint);
    }
}