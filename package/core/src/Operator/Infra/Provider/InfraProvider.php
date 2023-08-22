<?php

namespace Epush\Core\Operator\Infra\Provider;

use Epush\Core\Operator\Infra\Database\Driver\OperatorDatabaseDriver;
use Epush\Core\Operator\Infra\Database\Driver\OperatorDatabaseDriverContract;

use Epush\Core\Operator\Infra\Database\Repository\OperatorRepository;
use Epush\Core\Operator\Infra\Database\Repository\Contract\OperatorRepositoryContract;

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
        $this->app->bind(OperatorRepositoryContract::class, OperatorRepository::class);

        $this->app->bind(OperatorDatabaseDriverContract::class, OperatorDatabaseDriver::class);
    }
}