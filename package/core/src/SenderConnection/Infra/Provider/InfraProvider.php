<?php

namespace Epush\Core\SenderConnection\Infra\Provider;

use Epush\Core\SenderConnection\Infra\Database\Driver\SenderConnectionDatabaseDriver;
use Epush\Core\SenderConnection\Infra\Database\Driver\SenderConnectionDatabaseDriverContract;

use Epush\Core\SenderConnection\Infra\Database\Repository\SenderConnectionRepository;
use Epush\Core\SenderConnection\Infra\Database\Repository\Contract\SenderConnectionRepositoryContract;

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
        $this->app->bind(SenderConnectionRepositoryContract::class, SenderConnectionRepository::class);

        $this->app->bind(SenderConnectionDatabaseDriverContract::class, SenderConnectionDatabaseDriver::class);
    }
}