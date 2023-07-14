<?php

namespace Epush\Orchi\Infra\Provider;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\CachesConfiguration;

class OrchiServiceProvider extends ServiceProvider
{
    public function boot() 
    {
    }

    public function register()
    {
        if (! ($this->app instanceof CachesConfiguration && $this->app->configurationIsCached())) {
            
            $config = $this->app->make('config');
            $config->set(
                'route-attributes.directories.Epush\\Orchi\\Present\\Http\\Controller\\', 
                base_path('package/orchi/src/Present/Http/Controller')
            );
        }

        $this->app->register(DomainProvider::class);
        $this->app->register(AppProvider::class);
        $this->app->register(InfraProvider::class);
    }
}