<?php

namespace Epush\SMS\Infra\Provider;

use Epush\SMS\Infra\EpushSMS\EpushSMSDriver;
use Epush\SMS\Infra\EpushSMS\EpushSMSDriverContract;

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
        $this->app->bind(EpushSMSDriverContract::class, EpushSMSDriver::class);
    }
}