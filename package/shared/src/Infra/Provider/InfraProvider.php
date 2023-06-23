<?php

namespace Epush\Shared\Infra\Provider;

use Illuminate\Support\ServiceProvider;
use Epush\Shared\Infra\Validator\ValidationDriver;
use Epush\Shared\Infra\Validator\ValidationDriverContract;

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
    }
}