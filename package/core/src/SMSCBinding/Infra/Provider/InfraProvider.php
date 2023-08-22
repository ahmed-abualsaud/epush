<?php

namespace Epush\Core\SMSCBinding\Infra\Provider;

use Epush\Core\SMSCBinding\Infra\Database\Driver\SMSCBindingDatabaseDriver;
use Epush\Core\SMSCBinding\Infra\Database\Driver\SMSCBindingDatabaseDriverContract;

use Epush\Core\SMSCBinding\Infra\Database\Repository\SMSCBindingRepository;
use Epush\Core\SMSCBinding\Infra\Database\Repository\Contract\SMSCBindingRepositoryContract;

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
        $this->app->bind(SMSCBindingRepositoryContract::class, SMSCBindingRepository::class);

        $this->app->bind(SMSCBindingDatabaseDriverContract::class, SMSCBindingDatabaseDriver::class);
    }
}