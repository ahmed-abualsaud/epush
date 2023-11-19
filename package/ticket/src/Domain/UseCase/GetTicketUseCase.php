<?php

namespace Epush\Ticket\Domain\UseCase;

use Epush\Ticket\Domain\DTO\TicketDto;
use Epush\Ticket\App\Contract\TicketServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetTicketUseCase
{
    public function __construct(

        private TicketServiceContract $ticketService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(TicketDto $ticketDto): array
    {
        $this->validationService->validate($ticketDto->toArray(), TicketDto::rules());
        return $this->ticketService->get($ticketDto->getTicketID());
    }
}