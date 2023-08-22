<?php

namespace Epush\Core\SenderConnection\Domain\UseCase;

use Epush\Core\SenderConnection\Domain\DTO\SenderConnectionDto;
use Epush\Core\SenderConnection\Domain\DTO\UpdateSenderConnectionDto;
use Epush\Core\SenderConnection\App\Contract\SenderConnectionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateSenderConnectionUseCase
{
    public function __construct(

        private SenderConnectionServiceContract $senderConnectionService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SenderConnectionDto $senderConnectionDto, UpdateSenderConnectionDto $updateSenderConnectionDto): array
    {
        $this->validationService->validate($senderConnectionDto->toArray(), SenderConnectionDto::rules());
        $this->validationService->validate($updateSenderConnectionDto->toArray(), UpdateSenderConnectionDto::rules());
        return $this->senderConnectionService->update($senderConnectionDto->getSenderConnectionID(), $updateSenderConnectionDto->toArray());
    }
}