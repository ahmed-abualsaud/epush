<?php

namespace Epush\Core\Sender\Domain\UseCase;

use Epush\Core\Sender\Domain\DTO\SenderDto;
use Epush\Core\Sender\App\Contract\SenderServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetSenderUseCase
{
    public function __construct(

        private SenderServiceContract $senderService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SenderDto $senderDto): array
    {
        $this->validationService->validate($senderDto->toArray(), SenderDto::rules());
        return $this->senderService->get($senderDto->getSenderID());
    }
}