<?php

namespace Epush\Expense;

use Epush\Expense\Order\Infra\Provider\OrderServiceProvider;
use Epush\Expense\PaymentMethod\Infra\Provider\PaymentMethodServiceProvider;

use Illuminate\Support\ServiceProvider;

class ExpenseServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->register(OrderServiceProvider::class);
        $this->app->register(PaymentMethodServiceProvider::class);
    }
}