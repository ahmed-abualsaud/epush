<?php

namespace Epush\Core\Pricelist\Infra\Provider;

use Epush\Core\Pricelist\App\Service\PricelistService;
use Epush\Core\Pricelist\App\Contract\PricelistServiceContract;

use Epush\Core\Pricelist\App\Service\PricelistDatabaseService;
use Epush\Core\Pricelist\App\Contract\PricelistDatabaseServiceContract;

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
        $this->app->bind(PricelistServiceContract::class, PricelistService::class);
        $this->app->bind(PricelistDatabaseServiceContract::class, PricelistDatabaseService::class);
    }
}