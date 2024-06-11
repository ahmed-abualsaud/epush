<?php

namespace Epush\Core\Partner\Infra\Provider;

use Epush\Core\Partner\Infra\Database\Driver\PartnerDatabaseDriver;
use Epush\Core\Partner\Infra\Database\Driver\PartnerDatabaseDriverContract;

use Epush\Core\Partner\Infra\Database\Repository\PartnerRepository;
use Epush\Core\Partner\Infra\Database\Repository\Contract\PartnerRepositoryContract;

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
        $this->app->bind(PartnerRepositoryContract::class, PartnerRepository::class);

        $this->app->bind(PartnerDatabaseDriverContract::class, PartnerDatabaseDriver::class);
    }
}