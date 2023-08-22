<?php

namespace Epush\Core\Country\Infra\Provider;

use Epush\Core\Country\App\Service\CountryService;
use Epush\Core\Country\App\Contract\CountryServiceContract;

use Epush\Core\Country\App\Service\CountryDatabaseService;
use Epush\Core\Country\App\Contract\CountryDatabaseServiceContract;

use Illuminate\Support\ServiceProvider;

class AppProvider extends ServiceProvider
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
        $this->app->bind(CountryServiceContract::class, CountryService::class);
        $this->app->bind(CountryDatabaseServiceContract::class, CountryDatabaseService::class);
    }
}