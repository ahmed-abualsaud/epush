<?php

namespace Epush\Orchi\Infra\Provider;

use Epush\Orchi\Infra\Database\Driver\OrchiDatabaseDriver;
use Epush\Orchi\Infra\Database\Repository\AppServiceRepository;
use Epush\Orchi\Infra\Database\Repository\ContextRepository;
use Epush\Orchi\Infra\Database\Repository\HandleGroupRepository;
use Epush\Orchi\Infra\Database\Repository\HandlerRepository;

use Epush\Orchi\Infra\Database\Driver\OrchiDatabaseDriverContract;
use Epush\Orchi\Infra\Database\Repository\Contract\AppServiceRepositoryContract;
use Epush\Orchi\Infra\Database\Repository\Contract\ContextRepositoryContract;
use Epush\Orchi\Infra\Database\Repository\Contract\HandleGroupRepositoryContract;
use Epush\Orchi\Infra\Database\Repository\Contract\HandlerRepositoryContract;

use Illuminate\Support\ServiceProvider;

class InfraProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AppServiceRepositoryContract::class, AppServiceRepository::class);
        $this->app->bind(ContextRepositoryContract::class, ContextRepository::class);
        $this->app->bind(HandleGroupRepositoryContract::class, HandleGroupRepository::class);
        $this->app->bind(HandlerRepositoryContract::class, HandlerRepository::class);
        $this->app->bind(OrchiDatabaseDriverContract::class, OrchiDatabaseDriver::class);
    }
}