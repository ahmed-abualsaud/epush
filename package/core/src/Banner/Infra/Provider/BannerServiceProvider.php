<?php

namespace Epush\Core\Banner\Infra\Provider;

use Illuminate\Contracts\Foundation\CachesConfiguration;

use Illuminate\Support\ServiceProvider;

class BannerServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        if (! ($this->app instanceof CachesConfiguration && $this->app->configurationIsCached())) {
            
            $config = $this->app->make('config');
            $config->set(
                'route-attributes.directories.Epush\\Core\\Banner\\Present\\Http\\Controller\\', 
                base_path('package/core/src/Banner/Present/Http/Controller')
            );
        }

        $this->app->register(DomainProvider::class);
        $this->app->register(AppProvider::class);
        $this->app->register(InfraProvider::class);
    }
}