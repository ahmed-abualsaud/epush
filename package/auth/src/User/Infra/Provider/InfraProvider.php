<?php

namespace Epush\Auth\User\Infra\Provider;

use Epush\Auth\User\App\Contract\BlockedIPDatabaseServiceContract;
use Epush\Auth\User\App\Service\BlockedIPDatabaseService;
use Epush\Auth\User\Infra\Credentials\CredentialsDriver;
use Epush\Auth\User\Infra\Database\Driver\UserDatabaseDriver;
use Epush\Auth\User\Infra\Database\Repository\UserRepository;
use Epush\Auth\User\Infra\Database\Repository\BlockedIPRepository;


use Epush\Auth\User\Infra\Credentials\CredentialsDriverContract;
use Epush\Auth\User\Infra\Database\Driver\UserDatabaseDriverContract;
use Epush\Auth\User\Infra\Database\Repository\Contract\UserRepositoryContract;
use Epush\Auth\User\Infra\Database\Repository\Contract\BlockedIPRepositoryContract;
use Epush\Auth\User\Infra\Recaptcha\RecaptchaDriver;
use Epush\Auth\User\Infra\Recaptcha\RecaptchaDriverContract;
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
        $this->app->bind(BlockedIPRepositoryContract::class, BlockedIPRepository::class);
        $this->app->bind(BlockedIPDatabaseServiceContract::class, BlockedIPDatabaseService::class);

        $this->app->bind(RecaptchaDriverContract::class, RecaptchaDriver::class);
        $this->app->bind(CredentialsDriverContract::class, CredentialsDriver::class);
        $this->app->bind(UserDatabaseDriverContract::class, UserDatabaseDriver::class);
    }
}