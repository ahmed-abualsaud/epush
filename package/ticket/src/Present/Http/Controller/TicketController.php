<?php

namespace Epush\Ticket\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Ticket\Domain\DTO\TicketDto;
use Epush\Ticket\Domain\DTO\AddTicketDto;
use Epush\Ticket\Domain\DTO\ListTicketsDto;
use Epush\Ticket\Domain\DTO\SearchTicketDto;
use Epush\Ticket\Domain\DTO\UpdateTicketDto;

use Epush\Ticket\Domain\UseCase\GetTicketUseCase;
use Epush\Ticket\Domain\UseCase\AddTicketUseCase;
use Epush\Ticket\Domain\UseCase\ListTicketsUseCase;
use Epush\Ticket\Domain\UseCase\DeleteTicketUseCase;
use Epush\Ticket\Domain\UseCase\SearchTicketUseCase;
use Epush\Ticket\Domain\UseCase\UpdateTicketUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/ticket')]
class TicketController
{
    #[Get('/')]
    public function listTickets(ListTicketsDto $listTicketsDto, ListTicketsUseCase $listTicketsUseCase): Response
    {
        return jsonResponse($listTicketsUseCase->execute($listTicketsDto));
    }

    #[Post('/')]
    public function addTicket(AddTicketDto $addTicketDto, AddTicketUseCase $addTicketUseCase): Response
    {
        return jsonResponse($addTicketUseCase->execute($addTicketDto));
    }

    #[Get('{ticket_id}')]
    public function getTicket(TicketDto $ticketDto, GetTicketUseCase $getTicketUseCase): Response
    {
        return jsonResponse($getTicketUseCase->execute($ticketDto));
    }

    #[Put('{ticket_id}')]
    public function updateTicket(TicketDto $ticketDto, UpdateTicketDto $updateTicketDto, UpdateTicketUseCase $updateTicketUseCase): Response
    {
        return jsonResponse($updateTicketUseCase->execute($ticketDto, $updateTicketDto));
    }

    #[Delete('{ticket_id}')]
    public function deleteTicket(TicketDto $ticketDto, DeleteTicketUseCase $deleteTicketUseCase): Response
    {
        return jsonResponse($deleteTicketUseCase->execute($ticketDto));
    }

    #[Post('/search')]
    public function searchTicketColumn(SearchTicketDto $searchTicketDto, SearchTicketUseCase $searchTicketUseCase): Response
    {
        return jsonResponse($searchTicketUseCase->execute($searchTicketDto));
    }
}