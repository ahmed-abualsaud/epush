<?php

namespace Epush\Core\Sender\Domain\UseCase;

use Epush\Core\Sender\Domain\DTO\AddSenderDto;
use Epush\Core\Sender\App\Contract\SenderServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddSenderUseCase
{
    public function __construct(

        private SenderServiceContract $senderService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddSenderDto $addSenderDto): array
    {
        $this->validationService->validate($addSenderDto->toArray(), AddSenderDto::rules());
        return $this->senderService->add($addSenderDto->toArray());
    }
}