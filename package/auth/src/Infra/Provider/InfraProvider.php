<?php

namespace Epush\Auth\Infra\Provider;

use Epush\Auth\Infra\Credentials\CredentialsDriver;
use Epush\Auth\Infra\Database\Driver\AuthDatabaseDriver;
use Epush\Auth\Infra\Database\Repository\UserRepository;
use Epush\Auth\Infra\Database\Repository\RoleRepository;
use Epush\Auth\Infra\Database\Repository\PermissionRepository;

use Epush\Auth\Infra\Credentials\CredentialsDriverContract;
use Epush\Auth\Infra\Database\Driver\AuthDatabaseDriverContract;
use Epush\Auth\Infra\Database\Repository\Contract\UserRepositoryContract;
use Epush\Auth\Infra\Database\Repository\Contract\RoleRepositoryContract;
use Epush\Auth\Infra\Database\Repository\Contract\PermissionRepositoryContract;

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
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(RoleRepositoryContract::class, RoleRepository::class);
        $this->app->bind(PermissionRepositoryContract::class, PermissionRepository::class);

        $this->app->bind(CredentialsDriverContract::class, CredentialsDriver::class);
        $this->app->bind(AuthDatabaseDriverContract::class, AuthDatabaseDriver::class);
    }
}