<?php

namespace Epush\Expense\PaymentMethod\Infra\Provider;

use Epush\Expense\PaymentMethod\Infra\Database\Driver\PaymentMethodDatabaseDriver;
use Epush\Expense\PaymentMethod\Infra\Database\Driver\PaymentMethodDatabaseDriverContract;

use Epush\Expense\PaymentMethod\Infra\Database\Repository\PaymentMethodRepository;
use Epush\Expense\PaymentMethod\Infra\Database\Repository\Contract\PaymentMethodRepositoryContract;

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
        $this->app->bind(PaymentMethodRepositoryContract::class, PaymentMethodRepository::class);

        $this->app->bind(PaymentMethodDatabaseDriverContract::class, PaymentMethodDatabaseDriver::class);
    }
}