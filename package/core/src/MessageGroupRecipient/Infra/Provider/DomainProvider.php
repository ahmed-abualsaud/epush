<?php

namespace Epush\Core\MessageGroupRecipient\Infra\Provider;

use Epush\Core\MessageGroupRecipient\Domain\DTO\MessageGroupRecipientDto;
use Epush\Core\MessageGroupRecipient\Domain\DTO\AddMessageGroupRecipientDto;
use Epush\Core\MessageGroupRecipient\Domain\DTO\ListMessageGroupRecipientsDto;
use Epush\Core\MessageGroupRecipient\Domain\DTO\SearchMessageGroupRecipientDto;
use Epush\Core\MessageGroupRecipient\Domain\DTO\UpdateMessageGroupRecipientDto;

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
        $this->app->bind(MessageGroupRecipientDto::class, function () {
            return new MessageGroupRecipientDto(['message_group_recipient_id' => $this->app->make('request')->route('message_group_recipient_id')]);
        });

        $this->app->bind(AddMessageGroupRecipientDto::class, function () {
            return new AddMessageGroupRecipientDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateMessageGroupRecipientDto::class, function () {
            return new UpdateMessageGroupRecipientDto($this->app->make('request')->route('message_group_recipient_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListMessageGroupRecipientsDto::class, function () {
            return new ListMessageGroupRecipientsDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchMessageGroupRecipientDto::class, function () {
            return new SearchMessageGroupRecipientDto($this->app->make('request')->all());
        });
    }
}