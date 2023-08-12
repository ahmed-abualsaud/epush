<?php

namespace Epush\Auth\Role\Infra\Provider;

use Epush\Auth\Role\Infra\Database\Driver\RoleDatabaseDriver;
use Epush\Auth\Role\Infra\Database\Repository\RoleRepository;

use Epush\Auth\Role\Infra\Database\Driver\RoleDatabaseDriverContract;
use Epush\Auth\Role\Infra\Database\Repository\Contract\RoleRepositoryContract;

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
        $this->app->bind(RoleRepositoryContract::class, RoleRepository::class);

        $this->app->bind(RoleDatabaseDriverContract::class, RoleDatabaseDriver::class);
    }
}