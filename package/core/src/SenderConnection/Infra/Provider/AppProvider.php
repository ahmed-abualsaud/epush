<?php

namespace Epush\Core\SenderConnection\Infra\Provider;

use Epush\Core\SenderConnection\App\Service\SenderConnectionService;
use Epush\Core\SenderConnection\App\Contract\SenderConnectionServiceContract;

use Epush\Core\SenderConnection\App\Service\SenderConnectionDatabaseService;
use Epush\Core\SenderConnection\App\Contract\SenderConnectionDatabaseServiceContract;

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
        $this->app->bind(SenderConnectionServiceContract::class, SenderConnectionService::class);
        $this->app->bind(SenderConnectionDatabaseServiceContract::class, SenderConnectionDatabaseService::class);
    }
}