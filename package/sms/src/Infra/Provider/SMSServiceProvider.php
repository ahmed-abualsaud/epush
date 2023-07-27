<?php

namespace Epush\SMS\Infra\Provider;

use Illuminate\Support\ServiceProvider;

class SMSServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }


    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/sms.php', 'sms');

        $this->app->register(AppProvider::class);
        $this->app->register(InfraProvider::class);
    }
}