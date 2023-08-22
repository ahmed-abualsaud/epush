<?php

namespace Epush\Core\SenderConnection\Infra\Provider;

use Epush\Core\SenderConnection\Domain\DTO\SenderConnectionDto;
use Epush\Core\SenderConnection\Domain\DTO\AddSenderConnectionDto;
use Epush\Core\SenderConnection\Domain\DTO\GetSenderConnectionsDto;
use Epush\Core\SenderConnection\Domain\DTO\ListSenderConnectionsDto;
use Epush\Core\SenderConnection\Domain\DTO\SearchSenderConnectionDto;
use Epush\Core\SenderConnection\Domain\DTO\UpdateSenderConnectionDto;

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
        $this->app->bind(SenderConnectionDto::class, function () {
            return new SenderConnectionDto(['sender_connection_id' => $this->app->make('request')->route('sender_connection_id')]);
        });

        $this->app->bind(GetSenderConnectionsDto::class, function () {
            return new GetSenderConnectionsDto(['sender_id' => $this->app->make('request')->route('sender_id')]);
        });

        $this->app->bind(AddSenderConnectionDto::class, function () {
            return new AddSenderConnectionDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateSenderConnectionDto::class, function () {
            return new UpdateSenderConnectionDto($this->app->make('request')->route('sender_connection_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListSenderConnectionsDto::class, function () {
            return new ListSenderConnectionsDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchSenderConnectionDto::class, function () {
            return new SearchSenderConnectionDto($this->app->make('request')->all());
        });
    }
}