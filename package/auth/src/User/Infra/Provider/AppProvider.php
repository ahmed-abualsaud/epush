<?php

namespace Epush\Auth\User\Infra\Provider;

use Epush\Auth\User\App\Service\UserService;
use Epush\Auth\User\App\Service\CredentialsService;
use Epush\Auth\User\App\Service\UserDatabaseService;

use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Auth\User\App\Contract\CredentialsServiceContract;
use Epush\Auth\User\App\Contract\UserDatabaseServiceContract;

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
        $this->app->bind(CredentialsServiceContract::class, CredentialsService::class);
        $this->app->bind(UserDatabaseServiceContract::class, UserDatabaseService::class);
    }
}