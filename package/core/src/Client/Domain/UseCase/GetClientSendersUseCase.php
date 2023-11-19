<?php

namespace Epush\Core\Client\Domain\UseCase;

use Epush\Core\Client\Domain\DTO\ClientDto;
use Epush\Core\Client\App\Contract\ClientServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetClientSendersUseCase
{
    public function __construct(

        private ClientServiceContract $clientService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ClientDto $clientDto): array
    {
        $this->validationService->validate($clientDto->toArray(), ClientDto::rules());
        return $this->clientService->getClientSenders($clientDto->getUserID());
    }
}