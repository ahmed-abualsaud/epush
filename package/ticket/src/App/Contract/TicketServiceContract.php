<?php

namespace Epush\Ticket\App\Contract;

interface TicketServiceContract
{
    public function list(int $take): array;

    public function get(string $ticketID): array;

    public function add(array $ticket): array;

    public function update(string $ticketID, array $ticket, string $mailContent = null): array;

    public function delete(string $ticketID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}