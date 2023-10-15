<?php

namespace Epush\SMS\Infra\Provider;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\CachesConfiguration;

class SMSServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }


    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/sms.php', 'sms');

        if (! ($this->app instanceof CachesConfiguration && $this->app->configurationIsCached())) {
            
            $config = $this->app->make('config');
            $config->set(
                'route-attributes.directories.Epush\\SMS\\Present\\Http\\Controller\\', 
                base_path('package/sms/src/Present/Http/Controller')
            );
        }

        $this->app->register(DomainProvider::class);
        $this->app->register(AppProvider::class);
        $this->app->register(InfraProvider::class);
    }
}