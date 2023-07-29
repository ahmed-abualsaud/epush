<?php

namespace Epush\Core\Infra\Provider;

use Epush\Core\Infra\Database\Driver\CoreDatabaseDriver;
use Epush\Core\Infra\Database\Driver\CoreDatabaseDriverContract;

use Epush\Core\Infra\Database\Repository\ClientRepository;
use Epush\Core\Infra\Database\Repository\Contract\ClientRepositoryContract;

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

        $this->app->bind(CoreDatabaseDriverContract::class, CoreDatabaseDriver::class);
    }
}