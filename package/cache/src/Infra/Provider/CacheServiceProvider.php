<?php

namespace Epush\Cache\Infra\Provider;

use Illuminate\Contracts\Foundation\CachesConfiguration;

use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        if (! ($this->app instanceof CachesConfiguration && $this->app->configurationIsCached())) {
            
            $this->app->make('config')->set('cache', require __DIR__.'/../Config/cache.php');
        }

        $this->app->register(AppProvider::class);
        $this->app->register(InfraProvider::class);
    }
}