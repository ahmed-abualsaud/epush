<?php

namespace Epush\Ticket\App\Service;

use Epush\Ticket\App\Contract\TicketServiceContract;
use Epush\Ticket\App\Contract\TicketDatabaseServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class TicketService implements TicketServiceContract
{
    public function __construct(

        private TicketDatabaseServiceContract $ticketDatabaseService,
        private InterprocessCommunicationEngineContract $communicationEngine

    ) {}


    public function list(int $take): array
    {
        return $this->ticketDatabaseService->paginateTickets($take);
    }

    public function get(string $ticketID): array
    {
        return $this->ticketDatabaseService->getTicket($ticketID);
    }

    public function add(array $ticket): array
    {
        $this->communicationEngine->broadcast(
            "mail:send-to",
            config('ticket.contact_us_email_address'),
            config('ticket.contact_us_email_subject'),
            $ticket['content']
        );
        return $this->ticketDatabaseService->addTicket($ticket);
    }

    public function update(string $ticketID, array $ticket, string $mailContent = null): array
    {
        if (! empty($mailContent)) {
            $tkt = $this->get($ticketID);
            $this->communicationEngine->broadcast("mail:send-to", $tkt['email'], "Complaint Status Updated", $mailContent);
        }
        return $this->ticketDatabaseService->updateTicket($ticketID, $ticket);
    }

    public function delete(string $ticketID): bool
    {
        return $this->ticketDatabaseService->deleteTicket($ticketID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return $this->ticketDatabaseService->searchTicketColumn($column, $value, $take);
    }
}