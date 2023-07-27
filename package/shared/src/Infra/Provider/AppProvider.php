<?php

namespace Epush\Shared\Infra\Provider;

use Epush\Shared\App\Service\FileService;
use Epush\Shared\App\Contract\FileServiceContract;

use Epush\Shared\App\Service\OrchiService;
use Epush\Shared\App\Contract\OrchiServiceContract;

use Epush\Shared\App\Service\ValidationService;
use Epush\Shared\App\Contract\ValidationServiceContract;

use Epush\Shared\App\Service\ScanningService;
use Epush\Shared\App\Contract\ScanningServiceContract;

use Epush\Shared\App\Service\SMSService;
use Epush\Shared\App\Contract\SMSServiceContract;

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

        $this->app->bind(OrchiServiceContract::class, OrchiService::class);
        $this->app->bind(FileServiceContract::class, FileService::class);
        $this->app->bind(SMSServiceContract::class, SMSService::class);
    }
}