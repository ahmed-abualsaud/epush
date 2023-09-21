<?php

namespace Epush\Core\MessageSegment\Infra\Provider;

use Epush\Core\MessageSegment\Domain\DTO\ListMessageSegmentsDto;
use Epush\Core\MessageSegment\Domain\DTO\SearchMessageSegmentDto;

use Illuminate\Support\ServiceProvider;

class DomainProvider extends ServiceProvider
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
        $this->app->bind(ListMessageSegmentsDto::class, function () {
            return new ListMessageSegmentsDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchMessageSegmentDto::class, function () {
            return new SearchMessageSegmentDto($this->app->make('request')->all());
        });
    }
}