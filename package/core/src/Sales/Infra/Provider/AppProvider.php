<?php

namespace Epush\Core\Sales\Infra\Provider;

use Epush\Core\Sales\App\Service\SalesService;
use Epush\Core\Sales\App\Contract\SalesServiceContract;

use Epush\Core\Sales\App\Service\SalesDatabaseService;
use Epush\Core\Sales\App\Contract\SalesDatabaseServiceContract;

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
        $this->app->bind(SalesServiceContract::class, SalesService::class);
        $this->app->bind(SalesDatabaseServiceContract::class, SalesDatabaseService::class);
    }
}