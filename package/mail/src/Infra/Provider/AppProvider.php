<?php

namespace Epush\Mail\Infra\Provider;

use Epush\Mail\App\Service\MailService;
use Epush\Mail\App\Service\MailDatabaseService;

use Epush\Mail\App\Contract\MailServiceContract;
use Epush\Mail\App\Contract\MailDatabaseServiceContract;

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
        $this->app->bind(MailServiceContract::class, MailService::class);
        $this->app->bind(MailDatabaseServiceContract::class, MailDatabaseService::class);
    }
}