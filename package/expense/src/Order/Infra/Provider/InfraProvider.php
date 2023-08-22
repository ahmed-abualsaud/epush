<?php

namespace Epush\Expense\Order\Infra\Provider;

use Epush\Expense\Order\Infra\Database\Driver\OrderDatabaseDriver;
use Epush\Expense\Order\Infra\Database\Driver\OrderDatabaseDriverContract;

use Epush\Expense\Order\Infra\Database\Repository\OrderRepository;
use Epush\Expense\Order\Infra\Database\Repository\Contract\OrderRepositoryContract;

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
        $this->app->bind(OrderRepositoryContract::class, OrderRepository::class);

        $this->app->bind(OrderDatabaseDriverContract::class, OrderDatabaseDriver::class);
    }
}