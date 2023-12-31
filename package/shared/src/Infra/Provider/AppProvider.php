<?php

namespace Epush\Shared\Infra\Provider;

use Epush\Shared\App\Service\ScanningService;
use Epush\Shared\App\Contract\ScanningServiceContract;

use Epush\Shared\App\Service\ValidationService;
use Epush\Shared\App\Contract\ValidationServiceContract;

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
        $this->app->bind(ScanningServiceContract::class, ScanningService::class);
        $this->app->bind(ValidationServiceContract::class, ValidationService::class);
    }
}