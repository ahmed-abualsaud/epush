<?php

namespace Epush\Ticket\Domain\UseCase;

use Epush\Ticket\Domain\DTO\TicketDto;
use Epush\Ticket\Domain\DTO\UpdateTicketDto;
use Epush\Ticket\App\Contract\TicketServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateTicketUseCase
{
    public function __construct(

        private TicketServiceContract $ticketService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(TicketDto $ticketDto, UpdateTicketDto $updateTicketDto): array
    {
        $this->validationService->validate($ticketDto->toArray(), TicketDto::rules());
        $this->validationService->validate($updateTicketDto->toArray(), UpdateTicketDto::rules());
        return $this->ticketService->update(
            $ticketDto->getTicketID(),
            $updateTicketDto->getTicket(),
            $updateTicketDto->getMailContent()
        );
    }
}