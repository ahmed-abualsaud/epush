<?php

namespace Epush\Core\SenderConnection\Domain\UseCase;

use Epush\Core\SenderConnection\Domain\DTO\SenderConnectionDto;
use Epush\Core\SenderConnection\App\Contract\SenderConnectionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetSenderConnectionUseCase
{
    public function __construct(

        private SenderConnectionServiceContract $senderConnectionService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SenderConnectionDto $senderConnectionDto): array
    {
        $this->validationService->validate($senderConnectionDto->toArray(), SenderConnectionDto::rules());
        return $this->senderConnectionService->get($senderConnectionDto->getSenderConnectionID());
    }
}