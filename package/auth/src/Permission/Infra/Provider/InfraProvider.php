<?php

namespace Epush\Auth\Permission\Infra\Provider;

use Epush\Auth\Permission\Infra\Database\Driver\PermissionDatabaseDriver;
use Epush\Auth\Permission\Infra\Database\Driver\PermissionDatabaseDriverContract;

use Epush\Auth\Permission\Infra\Database\Repository\PermissionRepository;
use Epush\Auth\Permission\Infra\Database\Repository\Contract\PermissionRepositoryContract;

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
        $this->app->bind(PermissionRepositoryContract::class, PermissionRepository::class);

        $this->app->bind(PermissionDatabaseDriverContract::class, PermissionDatabaseDriver::class);
    }
}