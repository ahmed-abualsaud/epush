<?php

namespace Epush\Mail\Infra\Provider;

use Illuminate\Contracts\Foundation\CachesConfiguration;
use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }


    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/mail.php', 'mail');

        if (! ($this->app instanceof CachesConfiguration && $this->app->configurationIsCached())) {
            
            $config = $this->app->make('config');
            $config->set(
                'route-attributes.directories.Epush\\Mail\\Present\\Http\\Controller\\', 
                base_path('package/mail/src/Present/Http/Controller')
            );
        }

        $this->app->register(DomainProvider::class);
        $this->app->register(AppProvider::class);
        $this->app->register(InfraProvider::class);
    }
}