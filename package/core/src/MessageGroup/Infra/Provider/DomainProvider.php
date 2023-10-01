<?php

namespace Epush\Core\MessageGroup\Infra\Provider;

use Epush\Core\MessageGroup\Domain\DTO\MessageGroupDto;
use Epush\Core\MessageGroup\Domain\DTO\AddMessageGroupDto;
use Epush\Core\MessageGroup\Domain\DTO\ListMessageGroupsDto;
use Epush\Core\MessageGroup\Domain\DTO\SearchMessageGroupDto;
use Epush\Core\MessageGroup\Domain\DTO\UpdateMessageGroupDto;

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
        $this->app->bind(MessageGroupDto::class, function () {
            return new MessageGroupDto(['message_group_id' => $this->app->make('request')->route('message_group_id')]);
        });

        $this->app->bind(AddMessageGroupDto::class, function () {
            return new AddMessageGroupDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateMessageGroupDto::class, function () {
            return new UpdateMessageGroupDto($this->app->make('request')->route('message_group_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListMessageGroupsDto::class, function () {
            return new ListMessageGroupsDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchMessageGroupDto::class, function () {
            return new SearchMessageGroupDto($this->app->make('request')->all());
        });
    }
}