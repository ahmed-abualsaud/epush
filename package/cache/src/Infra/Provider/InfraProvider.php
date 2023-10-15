<?php

namespace Epush\Cache\Infra\Provider;

use Illuminate\Support\ServiceProvider;

use Epush\Cache\Infra\Driver\CacheDriver;
use Epush\Cache\Infra\Driver\CacheDriverContract;


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

        $this->app->bind(CacheDriverContract::class, CacheDriver::class);
    }
}