<?php

namespace Epush\Core\MessageSegment\Infra\Provider;

use Epush\Core\MessageSegment\App\Service\MessageSegmentService;
use Epush\Core\MessageSegment\App\Contract\MessageSegmentServiceContract;

use Epush\Core\MessageSegment\App\Service\MessageSegmentDatabaseService;
use Epush\Core\MessageSegment\App\Contract\MessageSegmentDatabaseServiceContract;

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
        $this->app->bind(MessageSegmentServiceContract::class, MessageSegmentService::class);
        $this->app->bind(MessageSegmentDatabaseServiceContract::class, MessageSegmentDatabaseService::class);
    }
}