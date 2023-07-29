<?php

namespace Epush\Core\Domain\UseCase;

use Epush\Core\App\Contract\ClientServiceContract;
use Epush\Core\Domain\DTO\ClientDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetClientUseCase
{
    public function __construct(

        private ClientServiceContract $clientService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ClientDto $clientDto): array
    {
        $this->validationService->validate($clientDto->toArray(), ClientDto::rules());
        return $this->clientService->get($clientDto->getClientID());
    }
}