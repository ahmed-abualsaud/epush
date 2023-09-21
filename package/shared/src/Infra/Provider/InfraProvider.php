<?php

namespace Epush\Shared\Infra\Provider;

use Illuminate\Support\ServiceProvider;
use Epush\Shared\Infra\Validator\ValidationDriver;
use Epush\Shared\Infra\Validator\ValidationDriverContract;
use Epush\Shared\Infra\InterprocessCommunication\InterprocessCommunicationServiceProvider;

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
        $this->app->bind(ValidationDriverContract::class, ValidationDriver::class);

        $this->app->register(InterprocessCommunicationServiceProvider::class);

    }
}