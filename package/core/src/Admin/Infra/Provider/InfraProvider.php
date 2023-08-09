<?php

namespace Epush\Core\Admin\Infra\Provider;

use Epush\Core\Admin\Infra\Database\Driver\AdminDatabaseDriver;
use Epush\Core\Admin\Infra\Database\Driver\AdminDatabaseDriverContract;

use Epush\Core\Admin\Infra\Database\Repository\AdminRepository;
use Epush\Core\Admin\Infra\Database\Repository\Contract\AdminRepositoryContract;

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
        $this->app->bind(AdminRepositoryContract::class, AdminRepository::class);

        $this->app->bind(AdminDatabaseDriverContract::class, AdminDatabaseDriver::class);
    }
}