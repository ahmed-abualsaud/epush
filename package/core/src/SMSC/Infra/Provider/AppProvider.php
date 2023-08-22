<?php

namespace Epush\Core\SMSC\Infra\Provider;

use Epush\Core\SMSC\App\Service\SMSCService;
use Epush\Core\SMSC\App\Contract\SMSCServiceContract;

use Epush\Core\SMSC\App\Service\SMSCDatabaseService;
use Epush\Core\SMSC\App\Contract\SMSCDatabaseServiceContract;

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
        $this->app->bind(SMSCServiceContract::class, SMSCService::class);
        $this->app->bind(SMSCDatabaseServiceContract::class, SMSCDatabaseService::class);
    }
}