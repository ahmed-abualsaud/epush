<?php

namespace Epush\Core\Operator\Infra\Provider;

use Epush\Core\Operator\Domain\DTO\OperatorDto;
use Epush\Core\Operator\Domain\DTO\AddOperatorDto;
use Epush\Core\Operator\Domain\DTO\ListOperatorsDto;
use Epush\Core\Operator\Domain\DTO\SearchOperatorDto;
use Epush\Core\Operator\Domain\DTO\UpdateOperatorDto;

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
        $this->app->bind(OperatorDto::class, function () {
            return new OperatorDto(['operator_id' => $this->app->make('request')->route('operator_id')]);
        });

        $this->app->bind(AddOperatorDto::class, function () {
            return new AddOperatorDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateOperatorDto::class, function () {
            return new UpdateOperatorDto($this->app->make('request')->route('operator_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListOperatorsDto::class, function () {
            return new ListOperatorsDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchOperatorDto::class, function () {
            return new SearchOperatorDto($this->app->make('request')->all());
        });
    }
}