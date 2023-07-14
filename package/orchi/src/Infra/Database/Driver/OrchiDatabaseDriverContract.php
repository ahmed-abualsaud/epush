<?php

namespace Epush\Orchi\Infra\Database\Driver;

use Epush\Orchi\Infra\Database\Repository\Contract\ContextRepositoryContract;
use Epush\Orchi\Infra\Database\Repository\Contract\HandlerRepositoryContract;
use Epush\Orchi\Infra\Database\Repository\Contract\AppServiceRepositoryContract;
use Epush\Orchi\Infra\Database\Repository\Contract\HandleGroupRepositoryContract;

interface OrchiDatabaseDriverContract
{
    public function appServiceRepository(): AppServiceRepositoryContract;

    public function contextRepository(): ContextRepositoryContract;

    public function handleGroupRepository(): HandleGroupRepositoryContract;

    public function handlerRepository(): HandlerRepositoryContract;
}