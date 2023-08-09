<?php

namespace Epush\Core\Sales\Infra\Provider;

use Epush\Core\Sales\Infra\Database\Driver\SalesDatabaseDriver;
use Epush\Core\Sales\Infra\Database\Driver\SalesDatabaseDriverContract;

use Epush\Core\Sales\Infra\Database\Repository\SalesRepository;
use Epush\Core\Sales\Infra\Database\Repository\Contract\SalesRepositoryContract;

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
        $this->app->bind(SalesRepositoryContract::class, SalesRepository::class);

        $this->app->bind(SalesDatabaseDriverContract::class, SalesDatabaseDriver::class);
    }
}