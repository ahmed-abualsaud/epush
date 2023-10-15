<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Cache\App\Contract\CacheServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;


class GetFromCacheMicroprocess implements MicroprocessContract
{
    public function __construct(

        private CacheServiceContract $cacheService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$key] = $data;
        $default = count($data) >= 2 ? $data[1] : null;

        return $this->cacheService->get($key, $default);
    }
}