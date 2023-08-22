<?php

namespace Epush\Core\Sender\Infra\Provider;

use Epush\Core\Sender\App\Service\SenderService;
use Epush\Core\Sender\App\Contract\SenderServiceContract;

use Epush\Core\Sender\App\Service\SenderDatabaseService;
use Epush\Core\Sender\App\Contract\SenderDatabaseServiceContract;

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
        $this->app->bind(SenderServiceContract::class, SenderService::class);
        $this->app->bind(SenderDatabaseServiceContract::class, SenderDatabaseService::class);
    }
}