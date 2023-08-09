<?php

namespace Epush\Core\Client\Domain\UseCase;

use Epush\Core\Client\Domain\DTO\AddClientDto;
use Epush\Core\Client\App\Contract\ClientServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddClientUseCase
{
    public function __construct(

        private ClientServiceContract $clientService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddClientDto $addClientDto): array
    {
        $this->validationService->validate($addClientDto->toArray(), AddClientDto::rules());
        return $this->clientService->add($addClientDto->getClient(), $addClientDto->getUser());
    }
}