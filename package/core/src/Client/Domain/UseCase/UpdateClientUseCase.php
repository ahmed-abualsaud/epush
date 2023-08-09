<?php

namespace Epush\Core\Client\Domain\UseCase;

use Epush\Core\Client\Domain\DTO\ClientDto;
use Epush\Core\Client\Domain\DTO\UpdateClientDto;
use Epush\Core\Client\App\Contract\ClientServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateClientUseCase
{
    public function __construct(

        private ClientServiceContract $clientService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ClientDto $clientDto, UpdateClientDto $updateClientDto): array
    {
        $this->validationService->validate($clientDto->toArray(), ClientDto::rules());
        $this->validationService->validate($updateClientDto->toArray(), UpdateClientDto::rules());
        return $this->clientService->update($clientDto->getUserID(), $updateClientDto->getClient(), $updateClientDto->getUser());
    }
}