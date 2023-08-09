<?php

namespace Epush\Core\Pricelist\Infra\Provider;

use Epush\Core\Pricelist\Infra\Database\Driver\PricelistDatabaseDriver;
use Epush\Core\Pricelist\Infra\Database\Driver\PricelistDatabaseDriverContract;

use Epush\Core\Pricelist\Infra\Database\Repository\PricelistRepository;
use Epush\Core\Pricelist\Infra\Database\Repository\Contract\PricelistRepositoryContract;

use Illuminate\Support\ServiceProvider;

class InfraProvider extends ServiceProvider
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
        $this->app->bind(PricelistRepositoryContract::class, PricelistRepository::class);

        $this->app->bind(PricelistDatabaseDriverContract::class, PricelistDatabaseDriver::class);
    }
}