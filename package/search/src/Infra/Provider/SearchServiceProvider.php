<?php

namespace Epush\Search\Infra\Provider;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\CachesConfiguration;

class SearchServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }


    public function register()
    {
        if (! ($this->app instanceof CachesConfiguration && $this->app->configurationIsCached())) {
            
            $config = $this->app->make('config');
            $config->set(
                'route-attributes.directories.Epush\\Search\\Present\\Http\\Controller\\', 
                base_path('package/search/src/Present/Http/Controller')
            );
            $config->set('search', require __DIR__.'/../Config/search.php');
        }

        $this->app->register(AppProvider::class);
        $this->app->register(DomainProvider::class);
        $this->app->register(InfraProvider::class);
    }
}