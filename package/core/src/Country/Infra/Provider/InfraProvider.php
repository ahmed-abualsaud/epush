<?php

namespace Epush\Core\Country\Infra\Provider;

use Epush\Core\Country\Infra\Database\Driver\CountryDatabaseDriver;
use Epush\Core\Country\Infra\Database\Driver\CountryDatabaseDriverContract;

use Epush\Core\Country\Infra\Database\Repository\CountryRepository;
use Epush\Core\Country\Infra\Database\Repository\Contract\CountryRepositoryContract;

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
        $this->app->bind(CountryRepositoryContract::class, CountryRepository::class);

        $this->app->bind(CountryDatabaseDriverContract::class, CountryDatabaseDriver::class);
    }
}