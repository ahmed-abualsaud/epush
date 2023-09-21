<?php

namespace Epush\Core\MessageSegment\Infra\Provider;

use Epush\Core\MessageSegment\Infra\Database\Driver\MessageSegmentDatabaseDriver;
use Epush\Core\MessageSegment\Infra\Database\Driver\MessageSegmentDatabaseDriverContract;

use Epush\Core\MessageSegment\Infra\Database\Repository\MessageSegmentRepository;
use Epush\Core\MessageSegment\Infra\Database\Repository\Contract\MessageSegmentRepositoryContract;

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
        $this->app->bind(MessageSegmentRepositoryContract::class, MessageSegmentRepository::class);

        $this->app->bind(MessageSegmentDatabaseDriverContract::class, MessageSegmentDatabaseDriver::class);
    }
}