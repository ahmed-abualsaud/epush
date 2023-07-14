<?php

namespace Epush\Orchi\Infra\Provider;

use Epush\Orchi\App\Service\LookupService;
use Epush\Orchi\App\Service\MonitoringService;
use Epush\Orchi\App\Service\OrchiDatabaseService;

use Epush\Orchi\App\Contract\LookupServiceContract;
use Epush\Orchi\App\Contract\MonitoringServiceContract;
use Epush\Orchi\App\Contract\OrchiDatabaseServiceContract;

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
        $this->app->bind(LookupServiceContract::class, LookupService::class);
        $this->app->bind(MonitoringServiceContract::class, MonitoringService::class);
        $this->app->bind(OrchiDatabaseServiceContract::class, OrchiDatabaseService::class);
    }
}