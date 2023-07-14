<?php

namespace Epush\Auth\Infra\Provider;

use Epush\Auth\App\Service\UserService;
use Epush\Auth\App\Service\PermissionService;
use Epush\Auth\App\Service\CredentialsService;
use Epush\Auth\App\Service\AuthDatabaseService;

use Epush\Auth\App\Contract\UserServiceContract;
use Epush\Auth\App\Contract\PermissionServiceContract;
use Epush\Auth\App\Contract\CredentialsServiceContract;
use Epush\Auth\App\Contract\AuthDatabaseServiceContract;

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
        $this->app->bind(UserServiceContract::class, UserService::class);
        $this->app->bind(PermissionServiceContract::class, PermissionService::class);
        $this->app->bind(CredentialsServiceContract::class, CredentialsService::class);
        $this->app->bind(AuthDatabaseServiceContract::class, AuthDatabaseService::class);
    }
}