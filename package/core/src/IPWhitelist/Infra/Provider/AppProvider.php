<?php

namespace Epush\Core\IPWhitelist\Infra\Provider;

use Epush\Core\IPWhitelist\App\Service\IPWhitelistService;
use Epush\Core\IPWhitelist\App\Contract\IPWhitelistServiceContract;

use Epush\Core\IPWhitelist\App\Service\IPWhitelistDatabaseService;
use Epush\Core\IPWhitelist\App\Contract\IPWhitelistDatabaseServiceContract;

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
        $this->app->bind(IPWhitelistServiceContract::class, IPWhitelistService::class);
        $this->app->bind(IPWhitelistDatabaseServiceContract::class, IPWhitelistDatabaseService::class);
    }
}