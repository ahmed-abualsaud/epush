<?php

namespace Epush\Expense\PaymentMethod\Infra\Provider;

use Epush\Expense\PaymentMethod\Domain\DTO\PaymentMethodDto;
use Epush\Expense\PaymentMethod\Domain\DTO\AddPaymentMethodDto;
use Epush\Expense\PaymentMethod\Domain\DTO\UpdatePaymentMethodDto;

use Illuminate\Support\ServiceProvider;

class DomainProvider extends ServiceProvider
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
        $this->app->bind(PaymentMethodDto::class, function () {
            return new PaymentMethodDto(['payment_method_id' => $this->app->make('request')->route('payment_method_id')]);
        });

        $this->app->bind(AddPaymentMethodDto::class, function () {
            return new AddPaymentMethodDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdatePaymentMethodDto::class, function () {
            return new UpdatePaymentMethodDto($this->app->make('request')->route('payment_method_id'), $this->app->make('request')->all());
        });
    }
}