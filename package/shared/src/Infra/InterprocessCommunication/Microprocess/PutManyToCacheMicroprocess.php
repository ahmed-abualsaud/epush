<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Cache\App\Contract\CacheServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;


class PutManyToCacheMicroprocess implements MicroprocessContract
{
    public function __construct(

        private CacheServiceContract $cacheService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$values] = $data;
        $ttl = count($data) >= 3 ? $data[2] : null;

        return $this->cacheService->putMany($values, $ttl);
    }
}