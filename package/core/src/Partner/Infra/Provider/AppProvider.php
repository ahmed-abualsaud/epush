<?php

namespace Epush\Core\Partner\Infra\Provider;

use Epush\Core\Partner\App\Service\PartnerService;
use Epush\Core\Partner\App\Contract\PartnerServiceContract;

use Epush\Core\Partner\App\Service\PartnerDatabaseService;
use Epush\Core\Partner\App\Contract\PartnerDatabaseServiceContract;

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
        $this->app->bind(PartnerServiceContract::class, PartnerService::class);
        $this->app->bind(PartnerDatabaseServiceContract::class, PartnerDatabaseService::class);
    }
}