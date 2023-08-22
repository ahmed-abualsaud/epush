<?php

namespace Epush\Expense\Order\Infra\Provider;

use Epush\Expense\Order\App\Service\OrderService;
use Epush\Expense\Order\App\Contract\OrderServiceContract;

use Epush\Expense\Order\App\Service\OrderDatabaseService;
use Epush\Expense\Order\App\Contract\OrderDatabaseServiceContract;

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
        $this->app->bind(OrderServiceContract::class, OrderService::class);
        $this->app->bind(OrderDatabaseServiceContract::class, OrderDatabaseService::class);
    }
}