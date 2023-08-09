<?php

namespace Epush\Core\Client\Domain\UseCase;

use Epush\Core\Client\App\Contract\ClientServiceContract;
use Epush\Core\Client\Domain\DTO\ClientDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteClientUseCase
{
    public function __construct(

        private ClientServiceContract $clientService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ClientDto $clientDto): bool
    {
        $this->validationService->validate($clientDto->toArray(), ClientDto::rules());
        return $this->clientService->delete($clientDto->getUserID());
    }
}