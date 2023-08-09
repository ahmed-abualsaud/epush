<?php

namespace Epush\Core\Client\Infra\Provider;

use Epush\Core\Client\App\Service\ClientService;
use Epush\Core\Client\App\Contract\ClientServiceContract;

use Epush\Core\Client\App\Service\ClientDatabaseService;
use Epush\Core\Client\App\Contract\ClientDatabaseServiceContract;

use Illuminate\Support\ServiceProvider;

class AppProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ClientServiceContract::class, ClientService::class);
        $this->app->bind(ClientDatabaseServiceContract::class, ClientDatabaseService::class);
    }
}