<?php

namespace Epush\Expense\PaymentMethod\Infra\Provider;

use Epush\Expense\PaymentMethod\App\Service\PaymentMethodService;
use Epush\Expense\PaymentMethod\App\Contract\PaymentMethodServiceContract;

use Epush\Expense\PaymentMethod\App\Service\PaymentMethodDatabaseService;
use Epush\Expense\PaymentMethod\App\Contract\PaymentMethodDatabaseServiceContract;

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
        $this->app->bind(PaymentMethodServiceContract::class, PaymentMethodService::class);
        $this->app->bind(PaymentMethodDatabaseServiceContract::class, PaymentMethodDatabaseService::class);
    }
}