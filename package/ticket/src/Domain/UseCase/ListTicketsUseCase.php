<?php

namespace Epush\Ticket\Domain\UseCase;

use Epush\Ticket\Domain\DTO\ListTicketsDto;
use Epush\Ticket\App\Contract\TicketServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListTicketsUseCase
{
    public function __construct(

        private TicketServiceContract $ticketService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListTicketsDto $listTicketsDto): array
    {
        $this->validationService->validate($listTicketsDto->toArray(), ListTicketsDto::rules());
        return $this->ticketService->list($listTicketsDto->getPageSize());
    }
}