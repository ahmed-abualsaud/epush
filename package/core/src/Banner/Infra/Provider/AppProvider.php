<?php

namespace Epush\Core\Banner\Infra\Provider;

use Epush\Core\Banner\App\Service\BannerService;
use Epush\Core\Banner\App\Contract\BannerServiceContract;

use Epush\Core\Banner\App\Service\BannerDatabaseService;
use Epush\Core\Banner\App\Contract\BannerDatabaseServiceContract;

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
        $this->app->bind(BannerServiceContract::class, BannerService::class);
        $this->app->bind(BannerDatabaseServiceContract::class, BannerDatabaseService::class);
    }
}