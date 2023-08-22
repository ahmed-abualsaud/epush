<?php

namespace Epush\Core\Sender\Infra\Provider;

use Epush\Core\Sender\Infra\Database\Driver\SenderDatabaseDriver;
use Epush\Core\Sender\Infra\Database\Driver\SenderDatabaseDriverContract;

use Epush\Core\Sender\Infra\Database\Repository\SenderRepository;
use Epush\Core\Sender\Infra\Database\Repository\Contract\SenderRepositoryContract;

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
        $this->app->bind(SenderRepositoryContract::class, SenderRepository::class);

        $this->app->bind(SenderDatabaseDriverContract::class, SenderDatabaseDriver::class);
    }
}