<?php

namespace Epush\Core\Client\Infra\Provider;

use Epush\Core\Client\Infra\Database\Driver\ClientDatabaseDriver;
use Epush\Core\Client\Infra\Database\Driver\ClientDatabaseDriverContract;

use Epush\Core\Client\Infra\Database\Repository\ClientRepository;
use Epush\Core\Client\Infra\Database\Repository\Contract\ClientRepositoryContract;

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
        $this->app->bind(ClientRepositoryContract::class, ClientRepository::class);

        $this->app->bind(ClientDatabaseDriverContract::class, ClientDatabaseDriver::class);
    }
}