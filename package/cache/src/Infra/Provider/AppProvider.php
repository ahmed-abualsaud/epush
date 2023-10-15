<?php

namespace Epush\Cache\Infra\Provider;

use Illuminate\Support\ServiceProvider;

use Epush\Cache\App\Service\CacheService;
use Epush\Cache\App\Contract\CacheServiceContract;


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
        $this->app->bind(CacheServiceContract::class, CacheService::class);
    }
}