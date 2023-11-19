<?php

namespace Epush\Search\Infra\Provider;

use Epush\Search\Infra\Database\Driver\SearchDatabaseDriver;
use Epush\Search\Infra\Database\Driver\SearchDatabaseDriverContract;

use Epush\Search\Infra\Database\Repository\SearchRepository;
use Epush\Search\Infra\Database\Repository\Contract\SearchRepositoryContract;

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
        $this->app->bind(SearchRepositoryContract::class, SearchRepository::class);
        $this->app->bind(SearchDatabaseDriverContract::class, SearchDatabaseDriver::class);
    }
}