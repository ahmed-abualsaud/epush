<?php

namespace Epush\Ticket\Infra\Provider;

use Epush\Ticket\Domain\DTO\TicketDto;
use Epush\Ticket\Domain\DTO\AddTicketDto;
use Epush\Ticket\Domain\DTO\ListTicketsDto;
use Epush\Ticket\Domain\DTO\SearchTicketDto;
use Epush\Ticket\Domain\DTO\UpdateTicketDto;

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
        $this->app->bind(TicketDto::class, function () {
            return new TicketDto(['ticket_id' => $this->app->make('request')->route('ticket_id')]);
        });

        $this->app->bind(AddTicketDto::class, function () {
            return new AddTicketDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateTicketDto::class, function () {
            return new UpdateTicketDto($this->app->make('request')->route('ticket_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListTicketsDto::class, function () {
            return new ListTicketsDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchTicketDto::class, function () {
            return new SearchTicketDto($this->app->make('request')->all());
        });
    }
}