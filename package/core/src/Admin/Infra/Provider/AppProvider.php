<?php

namespace Epush\Core\Admin\Infra\Provider;

use Epush\Core\Admin\App\Service\AdminService;
use Epush\Core\Admin\App\Contract\AdminServiceContract;

use Epush\Core\Admin\App\Service\AdminDatabaseService;
use Epush\Core\Admin\App\Contract\AdminDatabaseServiceContract;

use Illuminate\Support\ServiceProvider;

class AppProvider extends ServiceProvider
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
        $this->app->bind(AdminServiceContract::class, AdminService::class);
        $this->app->bind(AdminDatabaseServiceContract::class, AdminDatabaseService::class);
    }
}