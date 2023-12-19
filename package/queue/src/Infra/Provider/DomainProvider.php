<?php

namespace Epush\Queue\Infra\Provider;

use Epush\Queue\Domain\DTO\QueueJobDto;
use Epush\Queue\Domain\DTO\ListQueueJobsDto;
use Epush\Queue\Domain\DTO\QueueFailedJobDto;
use Epush\Queue\Domain\DTO\SearchQueueJobDto;
use Epush\Queue\Domain\DTO\CheckQueueEnabledDto;
use Epush\Queue\Domain\DTO\CheckQueuesEnabledDto;
use Epush\Queue\Domain\DTO\EnableDisableQueueDto;
use Epush\Queue\Domain\DTO\EnableDisableQueuesDto;
use Epush\Queue\Domain\DTO\ListQueueFailedJobsDto;
use Epush\Queue\Domain\DTO\SearchQueueFailedJobDto;

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
        $this->app->bind(CheckQueueEnabledDto::class, function () {
            return new CheckQueueEnabledDto(['queue' => $this->app->make('request')->route('queue')]);
        });

        $this->app->bind(CheckQueuesEnabledDto::class, function () {
            return new CheckQueuesEnabledDto($this->app->make('request')->all());
        });

        $this->app->bind(EnableDisableQueueDto::class, function () {
            $inputs = $this->app->make('request')->all();
            $inputs['queue'] = $this->app->make('request')->route('queue');

            return new EnableDisableQueueDto($inputs);
        });

        $this->app->bind(EnableDisableQueuesDto::class, function () {
            return new EnableDisableQueuesDto($this->app->make('request')->all());
        });

        $this->app->bind(QueueJobDto::class, function () {
            return new QueueJobDto(['queue_id' => $this->app->make('request')->route('queue_id')]);
        });

        $this->app->bind(QueueFailedJobDto::class, function () {
            return new QueueFailedJobDto(['queue_id' => $this->app->make('request')->route('queue_id')]);
        });

        $this->app->bind(ListQueueJobsDto::class, function () {
            $inputs = $this->app->make('request')->all();
            $inputs['queue'] = $this->app->make('request')->route('queue');

            return new ListQueueJobsDto($inputs);
        });

        $this->app->bind(ListQueueFailedJobsDto::class, function () {
            $inputs = $this->app->make('request')->all();
            $inputs['queue'] = $this->app->make('request')->route('queue');

            return new ListQueueFailedJobsDto($inputs);
        });

        $this->app->bind(SearchQueueJobDto::class, function () {
            $inputs = $this->app->make('request')->all();
            $inputs['queue'] = $this->app->make('request')->route('queue');

            return new SearchQueueJobDto($inputs);
        });

        $this->app->bind(SearchQueueFailedJobDto::class, function () {
            $inputs = $this->app->make('request')->all();
            $inputs['queue'] = $this->app->make('request')->route('queue');

            return new SearchQueueFailedJobDto($inputs);
        });
    }
}