<?php

namespace Epush\Orchi\Infra\Provider;

use Illuminate\Support\ServiceProvider;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

use Illuminate\Contracts\Foundation\CachesConfiguration;

class OrchiServiceProvider extends ServiceProvider
{
    public function boot() 
    {
        $attributes = app(InterprocessCommunicationEngineContract::class)->broadcast("orchi:handlers:get-all-handlers-response-attributes")[0];

        $resultArray = [];
        foreach ($attributes as $item) {
            $resultArray[$item['endpoint']] = $item['response_attributes'];
        }

        app(InterprocessCommunicationEngineContract::class)->broadcast("cache:put-many", $resultArray)[0];
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