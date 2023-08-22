<?php

namespace Epush\Core\Country\Infra\Provider;

use Epush\Core\Country\Domain\DTO\CountryDto;
use Epush\Core\Country\Domain\DTO\AddCountryDto;
use Epush\Core\Country\Domain\DTO\ListCountriesDto;
use Epush\Core\Country\Domain\DTO\SearchCountryDto;
use Epush\Core\Country\Domain\DTO\UpdateCountryDto;

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
        $this->app->bind(CountryDto::class, function () {
            return new CountryDto(['country_id' => $this->app->make('request')->route('country_id')]);
        });

        $this->app->bind(AddCountryDto::class, function () {
            return new AddCountryDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateCountryDto::class, function () {
            return new UpdateCountryDto($this->app->make('request')->route('country_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListCountriesDto::class, function () {
            return new ListCountriesDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchCountryDto::class, function () {
            return new SearchCountryDto($this->app->make('request')->all());
        });
    }
}