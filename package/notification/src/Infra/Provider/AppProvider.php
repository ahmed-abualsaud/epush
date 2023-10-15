<?php

namespace Epush\Notification\Infra\Provider;

use Epush\Notification\App\Service\NotificationService;
use Epush\Notification\App\Contract\NotificationServiceContract;

use Epush\Notification\App\Service\NotificationDatabaseService;
use Epush\Notification\App\Contract\NotificationDatabaseServiceContract;

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
        $this->app->bind(NotificationServiceContract::class, NotificationService::class);
        $this->app->bind(NotificationDatabaseServiceContract::class, NotificationDatabaseService::class);
    }
}