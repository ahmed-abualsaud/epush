<?php

namespace Epush\Mail\Infra\Provider;

use Epush\Mail\App\Service\EpushMailService;
use Epush\Mail\App\Contract\EpushMailServiceContract;

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
        $this->app->bind(EpushMailServiceContract::class, EpushMailService::class);
    }
}