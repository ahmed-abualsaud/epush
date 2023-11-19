<?php

namespace Epush\Ticket\Domain\UseCase;

use Epush\Ticket\Domain\DTO\AddTicketDto;
use Epush\Ticket\App\Contract\TicketServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddTicketUseCase
{
    public function __construct(

        private TicketServiceContract $ticketService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddTicketDto $addTicketDto): array
    {
        $this->validationService->validate($addTicketDto->toArray(), AddTicketDto::rules());
        return $this->ticketService->add($addTicketDto->toArray());
    }
}