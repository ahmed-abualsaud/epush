<?php

namespace Epush\Core\BusinessField\Infra\Provider;

use Epush\Core\BusinessField\Infra\Database\Driver\BusinessFieldDatabaseDriver;
use Epush\Core\BusinessField\Infra\Database\Driver\BusinessFieldDatabaseDriverContract;

use Epush\Core\BusinessField\Infra\Database\Repository\BusinessFieldRepository;
use Epush\Core\BusinessField\Infra\Database\Repository\Contract\BusinessFieldRepositoryContract;

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
        $this->app->bind(BusinessFieldRepositoryContract::class, BusinessFieldRepository::class);

        $this->app->bind(BusinessFieldDatabaseDriverContract::class, BusinessFieldDatabaseDriver::class);
    }
}