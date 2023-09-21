<?php

namespace Epush\Core\Message\Infra\Provider;

use Epush\Core\Message\App\Service\MessageService;
use Epush\Core\Message\App\Contract\MessageServiceContract;

use Epush\Core\Message\App\Service\MessageDatabaseService;
use Epush\Core\Message\App\Contract\MessageDatabaseServiceContract;

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
        $this->app->bind(MessageServiceContract::class, MessageService::class);
        $this->app->bind(MessageDatabaseServiceContract::class, MessageDatabaseService::class);
    }
}