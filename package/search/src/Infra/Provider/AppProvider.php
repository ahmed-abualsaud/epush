<?php

namespace Epush\Search\Infra\Provider;

use Epush\Search\App\Service\SearchService;
use Epush\Search\App\Contract\SearchServiceContract;

use Epush\Search\App\Service\SearchDatabaseService;
use Epush\Search\App\Contract\SearchDatabaseServiceContract;

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
        $this->app->bind(SearchServiceContract::class, SearchService::class);
        $this->app->bind(SearchDatabaseServiceContract::class, SearchDatabaseService::class);
    }
}