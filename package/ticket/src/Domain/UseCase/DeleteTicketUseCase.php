<?php

namespace Epush\Ticket\Domain\UseCase;

use Epush\Ticket\App\Contract\TicketServiceContract;
use Epush\Ticket\Domain\DTO\TicketDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteTicketUseCase
{
    public function __construct(

        private TicketServiceContract $ticketService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(TicketDto $ticketDto): bool
    {
        $this->validationService->validate($ticketDto->toArray(), TicketDto::rules());
        return $this->ticketService->delete($ticketDto->getTicketID());
    }
}