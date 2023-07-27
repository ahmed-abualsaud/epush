<?php

namespace Epush\SMS\Infra\Provider;

use Epush\SMS\App\Service\EpushSMSService;
use Epush\SMS\App\Contract\EpushSMSServiceContract;

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
        $this->app->bind(EpushSMSServiceContract::class, EpushSMSService::class);
    }
}