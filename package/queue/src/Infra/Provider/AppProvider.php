<?php

namespace Epush\Queue\Infra\Provider;

use Epush\Queue\App\Service\QueueService;
use Epush\Queue\App\Contract\QueueServiceContract;

use Epush\Queue\App\Service\QueueDatabaseService;
use Epush\Queue\App\Contract\QueueDatabaseServiceContract;

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
        $this->app->bind(QueueServiceContract::class, QueueService::class);
        $this->app->bind(QueueDatabaseServiceContract::class, QueueDatabaseService::class);
    }
}