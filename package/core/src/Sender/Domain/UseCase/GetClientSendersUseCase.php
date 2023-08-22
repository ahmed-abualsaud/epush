<?php

namespace Epush\Core\Sender\Domain\UseCase;

use Epush\Core\Sender\Domain\DTO\GetClientSendersDto;
use Epush\Core\Sender\App\Contract\SenderServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetClientSendersUseCase
{
    public function __construct(

        private SenderServiceContract $senderService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(GetClientSendersDto $getClientSendersDto): array
    {
        $this->validationService->validate($getClientSendersDto->toArray(), GetClientSendersDto::rules());
        return $this->senderService->getClientSenders($getClientSendersDto->getUserID());
    }
}