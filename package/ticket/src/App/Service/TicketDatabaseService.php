<?php

namespace Epush\Ticket\App\Service;

use Epush\Ticket\App\Contract\TicketDatabaseServiceContract;
use Epush\Ticket\Infra\Database\Driver\TicketDatabaseDriverContract;

class TicketDatabaseService implements TicketDatabaseServiceContract
{
    public function __construct(

        private TicketDatabaseDriverContract $ticketDatabaseDriver

    ) {}

    public function getTicket(string $ticketID): array
    {
        return $this->ticketDatabaseDriver->ticketRepository()->get($ticketID);
    }

    public function paginateTickets(int $take): array
    {
        return $this->ticketDatabaseDriver->ticketRepository()->all($take);
    }

    public function addTicket(array $ticket): array
    {
        return $this->ticketDatabaseDriver->ticketRepository()->create($ticket);
    }

    public function updateTicket(string $ticketID, array $ticket): array
    {
        return $this->ticketDatabaseDriver->ticketRepository()->update($ticketID, $ticket);
    }

    public function deleteTicket(string $ticketID): bool
    {
        return $this->ticketDatabaseDriver->ticketRepository()->delete($ticketID);
    }

    public function searchTicketColumn(string $column, string $value, int $take = 10): array
    {
        return $this->ticketDatabaseDriver->ticketRepository()->searchColumn($column, $value, $take);
    }
}