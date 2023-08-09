<?php

namespace Epush\Core\BusinessField\Infra\Provider;

use Epush\Core\BusinessField\App\Service\BusinessFieldService;
use Epush\Core\BusinessField\App\Contract\BusinessFieldServiceContract;

use Epush\Core\BusinessField\App\Service\BusinessFieldDatabaseService;
use Epush\Core\BusinessField\App\Contract\BusinessFieldDatabaseServiceContract;

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
        $this->app->bind(BusinessFieldServiceContract::class, BusinessFieldService::class);
        $this->app->bind(BusinessFieldDatabaseServiceContract::class, BusinessFieldDatabaseService::class);
    }
}