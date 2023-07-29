<?php

namespace Epush\Core\Infra\Provider;

use Epush\Core\App\Service\ClientService;
use Epush\Core\App\Contract\ClientServiceContract;

use Epush\Core\App\Service\CoreDatabaseService;
use Epush\Core\App\Contract\CoreDatabaseServiceContract;

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
        $this->app->bind(CoreDatabaseServiceContract::class, CoreDatabaseService::class);
    }
}