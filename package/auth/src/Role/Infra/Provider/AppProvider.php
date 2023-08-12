<?php

namespace Epush\Auth\Role\Infra\Provider;

use Epush\Auth\Role\App\Service\RoleService;
use Epush\Auth\Role\App\Service\RoleDatabaseService;

use Epush\Auth\Role\App\Contract\RoleServiceContract;
use Epush\Auth\Role\App\Contract\RoleDatabaseServiceContract;

use Illuminate\Support\ServiceProvider;

class AppProvider extends ServiceProvider
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
        $this->app->bind(RoleServiceContract::class, RoleService::class);
        $this->app->bind(RoleDatabaseServiceContract::class, RoleDatabaseService::class);
    }
}