<?php

namespace Epush\Core\Domain\UseCase;

use Epush\Core\App\Contract\ClientServiceContract;
use Epush\Core\Domain\DTO\AddClientDto;
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