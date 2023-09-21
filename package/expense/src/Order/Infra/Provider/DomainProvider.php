<?php

namespace Epush\Expense\Order\Infra\Provider;

use Epush\Expense\Order\Domain\DTO\OrderDto;
use Epush\Expense\Order\Domain\DTO\AddOrderDto;
use Epush\Expense\Order\Domain\DTO\ListOrdersDto;
use Epush\Expense\Order\Domain\DTO\SearchOrderDto;
use Epush\Expense\Order\Domain\DTO\UpdateOrderDto;

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
        $this->app->bind(OrderDto::class, function () {
            return new OrderDto(['order_id' => $this->app->make('request')->route('order_id')]);
        });

        $this->app->bind(AddOrderDto::class, function () {
            return new AddOrderDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateOrderDto::class, function () {
            return new UpdateOrderDto($this->app->make('request')->route('order_id'), $this->app->make('request')->all());
        });
    
        $this->app->bind(ListOrdersDto::class, function () {
            return new ListOrdersDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchOrderDto::class, function () {
            return new SearchOrderDto($this->app->make('request')->all());
        });
    }
}