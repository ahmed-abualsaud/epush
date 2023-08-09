<?php

namespace Epush\Expense;

use Epush\Expense\PaymentMethod\Infra\Provider\PaymentMethodServiceProvider;

use Illuminate\Support\ServiceProvider;

class ExpenseServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->register(PaymentMethodServiceProvider::class);
    }
}