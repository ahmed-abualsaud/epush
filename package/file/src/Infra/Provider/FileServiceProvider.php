<?php

namespace Epush\File\Infra\Provider;

use Barryvdh\DomPDF\Facade;
use Illuminate\Support\ServiceProvider;

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
        $this->mergeConfigFrom(__DIR__.'/../Config/route-attributes.php', 'route-attributes');

        $this->app->register(DomainProvider::class);
        $this->app->register(AppProvider::class);
        $this->app->register(InfraProvider::class);
    }
}