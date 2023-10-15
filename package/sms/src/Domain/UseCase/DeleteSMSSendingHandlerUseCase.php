<?php

namespace Epush\SMS\Domain\UseCase;

use Epush\SMS\Domain\DTO\SMSSendingHandlerDto;
use Epush\SMS\App\Contract\SMSServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteSMSSendingHandlerUseCase
{
    public function __construct(

        private SMSServiceContract $smsService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SMSSendingHandlerDto $smsSendingHandlerDto): bool
    {
        $this->validationService->validate($smsSendingHandlerDto->toArray(), SMSSendingHandlerDto::rules());
        return $this->smsService->deleteSMSSendingHandler($smsSendingHandlerDto->getSMSSendingHandlerID());
    }
}