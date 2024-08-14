<?php

namespace Epush\Core\MessageReport\Infra\Provider;

use Epush\Core\MessageReport\App\Service\MessageReportService;
use Epush\Core\MessageReport\App\Contract\MessageReportServiceContract;

use Epush\Core\MessageReport\App\Service\MessageReportDatabaseService;
use Epush\Core\MessageReport\App\Contract\MessageReportDatabaseServiceContract;

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
        $this->app->bind(MessageReportServiceContract::class, MessageReportService::class);
        $this->app->bind(MessageReportDatabaseServiceContract::class, MessageReportDatabaseService::class);
    }
}