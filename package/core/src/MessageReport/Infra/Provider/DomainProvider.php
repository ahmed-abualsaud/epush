<?php

namespace Epush\Core\MessageReport\Infra\Provider;

use Epush\Core\MessageReport\Domain\DTO\MessageReportDto;
use Epush\Core\MessageReport\Domain\DTO\AddMessageReportDto;
use Epush\Core\MessageReport\Domain\DTO\ListMessageReportsDto;
use Epush\Core\MessageReport\Domain\DTO\SearchMessageReportDto;
use Epush\Core\MessageReport\Domain\DTO\UpdateMessageReportDto;

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
        $this->app->bind(MessageReportDto::class, function () {
            return new MessageReportDto(['message_id' => $this->app->make('request')->route('message_id')]);
        });

        $this->app->bind(AddMessageReportDto::class, function () {
            return new AddMessageReportDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateMessageReportDto::class, function () {
            return new UpdateMessageReportDto($this->app->make('request')->route('message_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListMessageReportsDto::class, function () {
            return new ListMessageReportsDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchMessageReportDto::class, function () {
            return new SearchMessageReportDto($this->app->make('request')->all());
        });
    }
}