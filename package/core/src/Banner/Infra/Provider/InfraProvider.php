<?php

namespace Epush\Core\Banner\Infra\Provider;

use Epush\Core\Banner\Infra\Database\Driver\BannerDatabaseDriver;
use Epush\Core\Banner\Infra\Database\Driver\BannerDatabaseDriverContract;

use Epush\Core\Banner\Infra\Database\Repository\BannerRepository;
use Epush\Core\Banner\Infra\Database\Repository\Contract\BannerRepositoryContract;

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
        $this->app->bind(BannerRepositoryContract::class, BannerRepository::class);

        $this->app->bind(BannerDatabaseDriverContract::class, BannerDatabaseDriver::class);
    }
}