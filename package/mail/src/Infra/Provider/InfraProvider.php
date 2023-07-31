<?php

namespace Epush\Mail\Infra\Provider;

use Epush\Mail\Infra\EpushMail\EpushMailDriver;
use Epush\Mail\Infra\EpushMail\EpushMailDriverContract;

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
        $this->app->bind(EpushMailDriverContract::class, EpushMailDriver::class);
    }
}