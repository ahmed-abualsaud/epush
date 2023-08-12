<?php

namespace Epush\Auth\Permission\Infra\Provider;

use Epush\Auth\Permission\App\Service\PermissionService;
use Epush\Auth\Permission\App\Service\PermissionDatabaseService;

use Epush\Auth\Permission\App\Contract\PermissionServiceContract;
use Epush\Auth\Permission\App\Contract\PermissionDatabaseServiceContract;

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
        $this->app->bind(PermissionServiceContract::class, PermissionService::class);
        $this->app->bind(PermissionDatabaseServiceContract::class, PermissionDatabaseService::class);
    }
}