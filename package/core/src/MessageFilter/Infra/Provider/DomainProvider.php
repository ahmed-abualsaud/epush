<?php

namespace Epush\Core\MessageFilter\Infra\Provider;

use Epush\Core\MessageFilter\Domain\DTO\MessageFilterDto;
use Epush\Core\MessageFilter\Domain\DTO\AddMessageFilterDto;
use Epush\Core\MessageFilter\Domain\DTO\ListMessageFiltersDto;
use Epush\Core\MessageFilter\Domain\DTO\SearchMessageFilterDto;
use Epush\Core\MessageFilter\Domain\DTO\UpdateMessageFilterDto;

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
        $this->app->bind(MessageFilterDto::class, function () {
            return new MessageFilterDto(['message_filter_id' => $this->app->make('request')->route('message_filter_id')]);
        });

        $this->app->bind(AddMessageFilterDto::class, function () {
            return new AddMessageFilterDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateMessageFilterDto::class, function () {
            return new UpdateMessageFilterDto($this->app->make('request')->route('message_filter_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListMessageFiltersDto::class, function () {
            return new ListMessageFiltersDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchMessageFilterDto::class, function () {
            return new SearchMessageFilterDto($this->app->make('request')->all());
        });
    }
}