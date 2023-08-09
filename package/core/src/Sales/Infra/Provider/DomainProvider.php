<?php

namespace Epush\Core\Sales\Infra\Provider;

use Epush\Core\Sales\Domain\DTO\SalesDto;
use Epush\Core\Sales\Domain\DTO\AddSalesDto;
use Epush\Core\Sales\Domain\DTO\UpdateSalesDto;

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
        $this->app->bind(SalesDto::class, function () {
            return new SalesDto(['sales_id' => $this->app->make('request')->route('sales_id')]);
        });

        $this->app->bind(AddSalesDto::class, function () {
            return new AddSalesDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateSalesDto::class, function () {
            return new UpdateSalesDto($this->app->make('request')->route('sales_id'), $this->app->make('request')->all());
        });
    }
}