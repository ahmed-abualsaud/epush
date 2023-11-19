<?php

namespace Epush\Ticket\Domain\UseCase;

use Epush\Ticket\Domain\DTO\SearchTicketDto;
use Epush\Ticket\App\Contract\TicketServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchTicketUseCase
{
    public function __construct(

        private TicketServiceContract $ticketService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchTicketDto $searchTicketDto): array
    {
        $this->validationService->validate($searchTicketDto->toArray(), SearchTicketDto::rules());
        return $this->ticketService->searchColumn(
            $searchTicketDto->getSearchColumn(),
            $searchTicketDto->getSearchValue(),
            $searchTicketDto->getPageSize()
        );
    }
}