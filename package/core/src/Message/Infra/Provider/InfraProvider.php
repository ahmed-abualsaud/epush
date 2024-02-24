<?php

namespace Epush\Core\Message\Infra\Provider;

use Epush\Core\Message\Infra\Driver\MessageDriver;
use Epush\Core\Message\Infra\Driver\MessageDriverContract;

use Epush\Core\Message\Infra\Database\Driver\MessageDatabaseDriver;
use Epush\Core\Message\Infra\Database\Repository\MessageRepository;
use Epush\Core\Message\Infra\Database\Driver\MessageDatabaseDriverContract;
use Epush\Core\Message\Infra\Database\Repository\Contract\MessageRepositoryContract;

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
        $this->app->bind(MessageRepositoryContract::class, MessageRepository::class);

        $this->app->bind(MessageDatabaseDriverContract::class, MessageDatabaseDriver::class);

        $this->app->bind(MessageDriverContract::class, MessageDriver::class);
    }
}