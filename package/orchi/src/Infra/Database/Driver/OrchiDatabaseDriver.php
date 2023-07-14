<?php

namespace Epush\Orchi\Infra\Database\Driver;

use Epush\Orchi\Infra\Database\Repository\Contract\ContextRepositoryContract;
use Epush\Orchi\Infra\Database\Repository\Contract\HandlerRepositoryContract;
use Epush\Orchi\Infra\Database\Repository\Contract\AppServiceRepositoryContract;
use Epush\Orchi\Infra\Database\Repository\Contract\HandleGroupRepositoryContract;

class OrchiDatabaseDriver
{
    public function __construct(

        private AppServiceRepositoryContract $appServiceRepository,
        private ContextRepositoryContract $contextRepository,
        private HandleGroupRepositoryContract $handleGroupRepository,
        private HandlerRepositoryContract $handlerRepository

    ) {}

    public function appServiceRepository(): AppServiceRepositoryContract
    {
        return $this->appServiceRepository;
    }

    public function contextRepository(): ContextRepositoryContract
    {
        return $this->contextRepository;
    }

    public function handleGroupRepository(): HandleGroupRepositoryContract
    {
        return $this->handleGroupRepository;
    }

    public function handlerRepository(): HandlerRepositoryContract
    {
        return $this->handlerRepository;
    }
}