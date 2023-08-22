<?php

namespace Epush\Core\SenderConnection\Domain\UseCase;

use Epush\Core\SenderConnection\Domain\DTO\GetSenderConnectionsDto;
use Epush\Core\SenderConnection\App\Contract\SenderConnectionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetSenderConnectionsUseCase
{
    public function __construct(

        private SenderConnectionServiceContract $senderConnectionService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(GetSenderConnectionsDto $getSenderConnectionsDto): array
    {
        $this->validationService->validate($getSenderConnectionsDto->toArray(), GetSenderConnectionsDto::rules());
        return $this->senderConnectionService->getSenderConnections($getSenderConnectionsDto->getSenderID());
    }
}