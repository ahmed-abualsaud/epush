<?php

namespace Epush\Core\Client\Domain\UseCase;

use Epush\Core\Client\Domain\DTO\ListClientsDto;
use Epush\Core\Client\App\Contract\ClientServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListClientsUseCase
{
    public function __construct(

        private ClientServiceContract $clientService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListClientsDto $listClientsDto): array
    {
        $this->validationService->validate($listClientsDto->toArray(), ListClientsDto::rules());
        return $this->clientService->list($listClientsDto->getPageSize(), $listClientsDto->getPartnerID());
    }
}