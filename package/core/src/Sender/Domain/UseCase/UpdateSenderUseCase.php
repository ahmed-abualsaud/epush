<?php

namespace Epush\Core\Sender\Domain\UseCase;

use Epush\Core\Sender\Domain\DTO\SenderDto;
use Epush\Core\Sender\Domain\DTO\UpdateSenderDto;
use Epush\Core\Sender\App\Contract\SenderServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateSenderUseCase
{
    public function __construct(

        private SenderServiceContract $senderService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SenderDto $senderDto, UpdateSenderDto $updateSenderDto): array
    {
        $this->validationService->validate($senderDto->toArray(), SenderDto::rules());
        $this->validationService->validate($updateSenderDto->toArray(), UpdateSenderDto::rules());
        return $this->senderService->update($senderDto->getSenderID(), $updateSenderDto->toArray());
    }
}