<?php

namespace Epush\Core\MessageReport\Infra\Provider;

use Epush\Core\MessageReport\Infra\Database\Driver\MessageReportDatabaseDriver;
use Epush\Core\MessageReport\Infra\Database\Driver\MessageReportDatabaseDriverContract;

use Epush\Core\MessageReport\Infra\Database\Repository\MessageReportRepository;
use Epush\Core\MessageReport\Infra\Database\Repository\Contract\MessageReportRepositoryContract;

use Epush\Core\MessageReport\Infra\Database\Repository\MessageClientReportRepository;
use Epush\Core\MessageReport\Infra\Database\Repository\Contract\MessageClientReportRepositoryContract;

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
        $this->app->bind(MessageReportRepositoryContract::class, MessageReportRepository::class);

        $this->app->bind(MessageClientReportRepositoryContract::class, MessageClientReportRepository::class);

        $this->app->bind(MessageReportDatabaseDriverContract::class, MessageReportDatabaseDriver::class);
    }
}