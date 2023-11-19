<?php

namespace Epush\Ticket\Infra\Provider;

use Epush\Ticket\App\Service\TicketService;
use Epush\Ticket\App\Contract\TicketServiceContract;

use Epush\Ticket\App\Service\TicketDatabaseService;
use Epush\Ticket\App\Contract\TicketDatabaseServiceContract;

use Illuminate\Support\ServiceProvider;

class AppProvider extends ServiceProvider
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
        $this->app->bind(TicketServiceContract::class, TicketService::class);
        $this->app->bind(TicketDatabaseServiceContract::class, TicketDatabaseService::class);
    }
}