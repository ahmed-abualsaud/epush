<?php

namespace Epush\Core\Message\Infra\Provider;

use Epush\Core\Message\Domain\DTO\MessageDto;
use Epush\Core\Message\Domain\DTO\AddMessageDto;
use Epush\Core\Message\Domain\DTO\ListMessagesDto;
use Epush\Core\Message\Domain\DTO\SearchMessageDto;
use Epush\Core\Message\Domain\DTO\UpdateMessageDto;
use Epush\Core\Message\Domain\DTO\BulkAddMessageDto;

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
        $this->app->bind(MessageDto::class, function () {
            return new MessageDto(['message_id' => $this->app->make('request')->route('message_id')]);
        });

        $this->app->bind(AddMessageDto::class, function () {
            return new AddMessageDto($this->app->make('request')->all());
        });

        $this->app->bind(BulkAddMessageDto::class, function () {
            return new BulkAddMessageDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateMessageDto::class, function () {
            return new UpdateMessageDto($this->app->make('request')->route('message_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListMessagesDto::class, function () {
            return new ListMessagesDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchMessageDto::class, function () {
            return new SearchMessageDto($this->app->make('request')->all());
        });
    }
}