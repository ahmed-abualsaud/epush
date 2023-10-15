<?php

namespace Epush\Notification\Infra\Provider;

use Illuminate\Support\Facades\Broadcast;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\CachesConfiguration;

class NotificationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Broadcast::routes();

        require base_path('routes/channels.php');
    }


    public function register()
    {
        if (! ($this->app instanceof CachesConfiguration && $this->app->configurationIsCached())) {
            
            $config = $this->app->make('config');
            $config->set(
                'route-attributes.directories.Epush\\Notification\\Present\\Http\\Controller\\', 
                base_path('package/notification/src/Present/Http/Controller')
            );

            $config->set('websockets', require __DIR__.'/../Config/websockets.php');
            $config->set('broadcasting', require __DIR__.'/../Config/broadcasting.php');
            $config->set('notification', require __DIR__.'/../Config/notification.php');
        }

        $this->app->register(DomainProvider::class);
        $this->app->register(AppProvider::class);
        $this->app->register(InfraProvider::class);
    }
}