<?php

namespace Epush\Ticket\Infra\Provider;

use Epush\Ticket\Infra\Database\Driver\TicketDatabaseDriver;
use Epush\Ticket\Infra\Database\Driver\TicketDatabaseDriverContract;

use Epush\Ticket\Infra\Database\Repository\TicketRepository;
use Epush\Ticket\Infra\Database\Repository\Contract\TicketRepositoryContract;

use Illuminate\Support\ServiceProvider;

class InfraProvider extends ServiceProvider
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
        $this->app->bind(TicketRepositoryContract::class, TicketRepository::class);

        $this->app->bind(TicketDatabaseDriverContract::class, TicketDatabaseDriver::class);
    }
}