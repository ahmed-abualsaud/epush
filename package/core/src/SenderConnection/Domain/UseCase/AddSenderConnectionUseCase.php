<?php

namespace Epush\Core\SenderConnection\Domain\UseCase;

use Epush\Core\SenderConnection\Domain\DTO\AddSenderConnectionDto;
use Epush\Core\SenderConnection\App\Contract\SenderConnectionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddSenderConnectionUseCase
{
    public function __construct(

        private SenderConnectionServiceContract $senderConnectionService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddSenderConnectionDto $addSenderConnectionDto): array
    {
        $this->validationService->validate($addSenderConnectionDto->toArray(), AddSenderConnectionDto::rules());
        return $this->senderConnectionService->add($addSenderConnectionDto->toArray());
    }
}