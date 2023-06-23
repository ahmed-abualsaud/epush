<?php

namespace Epush\Shared\Infra\Provider;

use Illuminate\Support\ServiceProvider;
use Epush\Shared\App\Services\ValidationService;
use Epush\Shared\App\Contracts\ValidationServiceContract;

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
        $this->app->bind(ValidationServiceContract::class, ValidationService::class);
    }
}