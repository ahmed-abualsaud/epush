<?php

namespace Epush\Core\Sender\Infra\Provider;

use Epush\Core\Sender\Domain\DTO\SenderDto;
use Epush\Core\Sender\Domain\DTO\AddSenderDto;
use Epush\Core\Sender\Domain\DTO\GetClientSendersDto;
use Epush\Core\Sender\Domain\DTO\ListSendersDto;
use Epush\Core\Sender\Domain\DTO\SearchSenderDto;
use Epush\Core\Sender\Domain\DTO\UpdateSenderDto;

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
        $this->app->bind(SenderDto::class, function () {
            return new SenderDto(['sender_id' => $this->app->make('request')->route('sender_id')]);
        });

        $this->app->bind(GetClientSendersDto::class, function () {
            return new GetClientSendersDto(['user_id' => $this->app->make('request')->route('user_id')]);
        });

        $this->app->bind(AddSenderDto::class, function () {
            return new AddSenderDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateSenderDto::class, function () {
            return new UpdateSenderDto($this->app->make('request')->route('sender_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListSendersDto::class, function () {
            return new ListSendersDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchSenderDto::class, function () {
            return new SearchSenderDto($this->app->make('request')->all());
        });
    }
}