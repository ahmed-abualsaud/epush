<?php

namespace Epush\Ticket\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Ticket\Infra\Database\Model\Ticket;
use Epush\Ticket\Infra\Database\Repository\Contract\TicketRepositoryContract;

class TicketRepository implements TicketRepositoryContract
{
    public function __construct(

        private Ticket $ticket
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->ticket->paginate($take)->toArray();

        });
    }

    public function get(string $ticketID): array
    {
        return DB::transaction(function () use ($ticketID) {

            $ticket =  $this->ticket->where('id', $ticketID)->first();
            return empty($ticket) ? [] : $ticket->toArray();
        });
    }
    
    public function create(array $ticket): array
    {
        return DB::transaction(function () use ($ticket) {

            return $this->ticket->create($ticket)->toArray();
        });
    }

    public function delete(string $ticketID): bool
    {
        return DB::transaction(function () use ($ticketID) {

            return $this->ticket->where('id', $ticketID)->delete();

        }); 
    }

    public function update(string $ticketID, array $data): array
    {
        return DB::transaction(function () use ($ticketID, $data) {

            $ticket = $this->ticket->where('id', $ticketID)->firstOrFail();

            if (! empty($data)) {
                $ticket->update($data);
            }

            return $ticket->toArray();

        }); 
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            return $this->ticket
                ->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
                ->paginate($take)->toArray();
        });
    }
}