<?php

namespace Epush\Core\MessageFilter\Infra\Provider;

use Epush\Core\MessageFilter\App\Service\MessageFilterService;
use Epush\Core\MessageFilter\App\Contract\MessageFilterServiceContract;

use Epush\Core\MessageFilter\App\Service\MessageFilterDatabaseService;
use Epush\Core\MessageFilter\App\Contract\MessageFilterDatabaseServiceContract;

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
        $this->app->bind(MessageFilterServiceContract::class, MessageFilterService::class);
        $this->app->bind(MessageFilterDatabaseServiceContract::class, MessageFilterDatabaseService::class);
    }
}