<?php

namespace Epush\Core\MessageGroup\Infra\Provider;

use Epush\Core\MessageGroup\App\Service\MessageGroupService;
use Epush\Core\MessageGroup\App\Contract\MessageGroupServiceContract;

use Epush\Core\MessageGroup\App\Service\MessageGroupDatabaseService;
use Epush\Core\MessageGroup\App\Contract\MessageGroupDatabaseServiceContract;

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
        $this->app->bind(MessageGroupServiceContract::class, MessageGroupService::class);
        $this->app->bind(MessageGroupDatabaseServiceContract::class, MessageGroupDatabaseService::class);
    }
}