<?php

namespace Epush\Core\Pricelist\Infra\Provider;

use Epush\Core\Pricelist\Domain\DTO\PricelistDto;
use Epush\Core\Pricelist\Domain\DTO\AddPricelistDto;
use Epush\Core\Pricelist\Domain\DTO\UpdatePricelistDto;

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
        $this->app->bind(PricelistDto::class, function () {
            return new PricelistDto(['pricelist_id' => $this->app->make('request')->route('pricelist_id')]);
        });

        $this->app->bind(AddPricelistDto::class, function () {
            return new AddPricelistDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdatePricelistDto::class, function () {
            return new UpdatePricelistDto($this->app->make('request')->route('pricelist_id'), $this->app->make('request')->all());
        });
    }
}