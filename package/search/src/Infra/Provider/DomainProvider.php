<?php

namespace Epush\Search\Infra\Provider;

use Epush\Search\Domain\DTO\SearchDto;

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
        $this->app->bind(SearchDto::class, function () {
            return new SearchDto($this->app->make('request')->all());
        });
    }
}