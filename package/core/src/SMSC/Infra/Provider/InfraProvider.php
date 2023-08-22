<?php

namespace Epush\Core\SMSC\Infra\Provider;

use Epush\Core\SMSC\Infra\Database\Driver\SMSCDatabaseDriver;
use Epush\Core\SMSC\Infra\Database\Driver\SMSCDatabaseDriverContract;

use Epush\Core\SMSC\Infra\Database\Repository\SMSCRepository;
use Epush\Core\SMSC\Infra\Database\Repository\Contract\SMSCRepositoryContract;

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
        $this->app->bind(SMSCRepositoryContract::class, SMSCRepository::class);

        $this->app->bind(SMSCDatabaseDriverContract::class, SMSCDatabaseDriver::class);
    }
}