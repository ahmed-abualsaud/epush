<?php

namespace Epush\Core\Sender\Domain\UseCase;

use Epush\Core\Sender\App\Contract\SenderServiceContract;
use Epush\Core\Sender\Domain\DTO\SenderDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteSenderUseCase
{
    public function __construct(

        private SenderServiceContract $senderService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SenderDto $senderDto): bool
    {
        $this->validationService->validate($senderDto->toArray(), SenderDto::rules());
        return $this->senderService->delete($senderDto->getSenderID());
    }
}