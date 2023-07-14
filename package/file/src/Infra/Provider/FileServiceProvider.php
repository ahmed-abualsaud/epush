<?php

namespace Epush\File\Infra\Provider;

use Barryvdh\DomPDF\Facade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\CachesConfiguration;

class FileServiceProvider extends ServiceProvider
{
    public function boot() 
    {
        $this->loadViewsFrom(__DIR__.'/../../Present/Views', 'file');
    }

    public function register()
    {
        app()->alias(Facade::class, 'PDF');

        $this->mergeConfigFrom(__DIR__.'/../Config/dompdf.php', 'dompdf');
        if (! ($this->app instanceof CachesConfiguration && $this->app->configurationIsCached())) {
            
            $config = $this->app->make('config');
            $config->set(
                'route-attributes.directories.Epush\\File\\Present\\Http\\Controller\\', 
                base_path('package/file/src/Present/Http/Controller')
            );
        }

        $this->app->register(DomainProvider::class);
        $this->app->register(AppProvider::class);
        $this->app->register(InfraProvider::class);
    }
}