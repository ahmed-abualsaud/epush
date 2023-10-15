<?php

namespace Epush\SMS\Infra\Provider;

use Epush\SMS\App\Service\SMSService;
use Epush\SMS\App\Contract\SMSServiceContract;

use Epush\SMS\App\Service\SMSDatabaseService;
use Epush\SMS\App\Contract\SMSDatabaseServiceContract;

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
        $this->app->bind(SMSServiceContract::class, SMSService::class);
        $this->app->bind(SMSDatabaseServiceContract::class, SMSDatabaseService::class);
    }
}