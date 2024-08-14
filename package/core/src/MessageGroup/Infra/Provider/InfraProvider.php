<?php

namespace Epush\Core\MessageGroup\Infra\Provider;

use Epush\Core\MessageGroup\Infra\Driver\MessageGroupDriver;
use Epush\Core\MessageGroup\Infra\Driver\MessageGroupDriverContract;

use Epush\Core\MessageGroup\Infra\Database\Driver\MessageGroupDatabaseDriver;
use Epush\Core\MessageGroup\Infra\Database\Driver\MessageGroupDatabaseDriverContract;

use Epush\Core\MessageGroup\Infra\Database\Repository\MessageGroupRepository;
use Epush\Core\MessageGroup\Infra\Database\Repository\Contract\MessageGroupRepositoryContract;

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
        $this->app->bind(MessageGroupRepositoryContract::class, MessageGroupRepository::class);

        $this->app->bind(MessageGroupDatabaseDriverContract::class, MessageGroupDatabaseDriver::class);

        $this->app->bind(MessageGroupDriverContract::class, MessageGroupDriver::class);

    }
}