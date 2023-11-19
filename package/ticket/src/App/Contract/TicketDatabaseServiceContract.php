<?php

namespace Epush\Ticket\App\Contract;

interface TicketDatabaseServiceContract
{
    public function getTicket(string $ticketID): array;

    public function addTicket(array $ticket): array;

    public function deleteTicket(string $ticketID): bool;

    public function updateTicket(string $ticketID, array $ticket): array;

    public function paginateTickets(int $take): array;

    public function searchTicketColumn(string $column, string $value, int $take = 10): array;
}