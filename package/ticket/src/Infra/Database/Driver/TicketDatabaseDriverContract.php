<?php

namespace Epush\Ticket\Infra\Database\Driver;

use Epush\Ticket\Infra\Database\Repository\Contract\TicketRepositoryContract;

interface TicketDatabaseDriverContract
{
    public function ticketRepository(): TicketRepositoryContract;
}