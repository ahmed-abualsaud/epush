<?php

namespace Epush\Ticket\Infra\Provider;

use Illuminate\Contracts\Foundation\CachesConfiguration;

use Illuminate\Support\ServiceProvider;

class TicketServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        if (! ($this->app instanceof CachesConfiguration && $this->app->configurationIsCached())) {
            
            $config = $this->app->make('config');
            $config->set(
                'route-attributes.directories.Epush\\Ticket\\Present\\Http\\Controller\\', 
                base_path('package/ticket/src/Present/Http/Controller')
            );
            $config->set('ticket', require __DIR__.'/../Config/ticket.php');
        }

        $this->app->register(DomainProvider::class);
        $this->app->register(AppProvider::class);
        $this->app->register(InfraProvider::class);
    }
}