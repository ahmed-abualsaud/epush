<?php

namespace Epush\Ticket\Infra\Database\Repository\Contract;

interface TicketRepositoryContract
{
    public function all(int $take): array;

    public function get(string $ticketID): array;

    public function create(array $ticket): array;

    public function update(string $ticketID, array $ticket): array;

    public function delete(string $id): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}