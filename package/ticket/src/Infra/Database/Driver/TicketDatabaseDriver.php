<?php

namespace Epush\Ticket\Infra\Database\Driver;

use Epush\Ticket\Infra\Database\Repository\Contract\TicketRepositoryContract;

class TicketDatabaseDriver implements TicketDatabaseDriverContract
{
    public function __construct(

        private TicketRepositoryContract $ticketRepository

    ) {}

    public function ticketRepository(): TicketRepositoryContract
    {
        return $this->ticketRepository;
    }
}