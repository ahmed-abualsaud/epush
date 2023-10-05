<?php

namespace Epush\Core\MessageFilter\Infra\Provider;

use Epush\Core\MessageFilter\Infra\Database\Driver\MessageFilterDatabaseDriver;
use Epush\Core\MessageFilter\Infra\Database\Driver\MessageFilterDatabaseDriverContract;

use Epush\Core\MessageFilter\Infra\Database\Repository\MessageFilterRepository;
use Epush\Core\MessageFilter\Infra\Database\Repository\Contract\MessageFilterRepositoryContract;

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
        $this->app->bind(MessageFilterRepositoryContract::class, MessageFilterRepository::class);

        $this->app->bind(MessageFilterDatabaseDriverContract::class, MessageFilterDatabaseDriver::class);
    }
}