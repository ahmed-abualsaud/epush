<?php

namespace Epush\Core\MessageRecipient\Infra\Provider;

use Epush\Core\MessageRecipient\Domain\DTO\ListMessageRecipientsDto;
use Epush\Core\MessageRecipient\Domain\DTO\SearchMessageRecipientDto;

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
        $this->app->bind(ListMessageRecipientsDto::class, function () {
            return new ListMessageRecipientsDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchMessageRecipientDto::class, function () {
            return new SearchMessageRecipientDto($this->app->make('request')->all());
        });
    }
}