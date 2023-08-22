<?php

namespace Epush\Core\SMSCBinding\Infra\Provider;

use Illuminate\Contracts\Foundation\CachesConfiguration;

use Illuminate\Support\ServiceProvider;

class SMSCBindingServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        if (! ($this->app instanceof CachesConfiguration && $this->app->configurationIsCached())) {
            
            $config = $this->app->make('config');
            $config->set(
                'route-attributes.directories.Epush\\Core\\SMSCBinding\\Present\\Http\\Controller\\', 
                base_path('package/core/src/SMSCBinding/Present/Http/Controller')
            );
        }

        $this->app->register(DomainProvider::class);
        $this->app->register(AppProvider::class);
        $this->app->register(InfraProvider::class);
    }
}