<?php

namespace Epush\Core\SMSCBinding\Infra\Provider;

use Epush\Core\SMSCBinding\App\Service\SMSCBindingService;
use Epush\Core\SMSCBinding\App\Contract\SMSCBindingServiceContract;

use Epush\Core\SMSCBinding\App\Service\SMSCBindingDatabaseService;
use Epush\Core\SMSCBinding\App\Contract\SMSCBindingDatabaseServiceContract;

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
        $this->app->bind(SMSCBindingServiceContract::class, SMSCBindingService::class);
        $this->app->bind(SMSCBindingDatabaseServiceContract::class, SMSCBindingDatabaseService::class);
    }
}