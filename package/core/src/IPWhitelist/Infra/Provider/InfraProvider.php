<?php

namespace Epush\Core\IPWhitelist\Infra\Provider;

use Epush\Core\IPWhitelist\Infra\Database\Driver\IPWhitelistDatabaseDriver;
use Epush\Core\IPWhitelist\Infra\Database\Driver\IPWhitelistDatabaseDriverContract;

use Epush\Core\IPWhitelist\Infra\Database\Repository\IPWhitelistRepository;
use Epush\Core\IPWhitelist\Infra\Database\Repository\Contract\IPWhitelistRepositoryContract;

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
        $this->app->bind(IPWhitelistRepositoryContract::class, IPWhitelistRepository::class);

        $this->app->bind(IPWhitelistDatabaseDriverContract::class, IPWhitelistDatabaseDriver::class);
    }
}