<?php

namespace Epush\Queue\Infra\Provider;

use Epush\Queue\Infra\Database\Driver\QueueDatabaseDriver;
use Epush\Queue\Infra\Database\Driver\QueueDatabaseDriverContract;

use Epush\Queue\Infra\Database\Repository\QueueRepository;
use Epush\Queue\Infra\Database\Repository\Contract\QueueRepositoryContract;

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
        $this->app->bind(QueueRepositoryContract::class, QueueRepository::class);

        $this->app->bind(QueueDatabaseDriverContract::class, QueueDatabaseDriver::class);
    }
}