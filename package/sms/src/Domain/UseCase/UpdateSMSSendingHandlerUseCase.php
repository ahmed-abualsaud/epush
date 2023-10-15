<?php

namespace Epush\SMS\Domain\UseCase;

use Epush\SMS\App\Contract\SMSServiceContract;
use Epush\SMS\Domain\DTO\SMSSendingHandlerDto;
use Epush\SMS\Domain\DTO\UpdateSMSSendingHandlerDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateSMSSendingHandlerUseCase
{
    public function __construct(

        private SMSServiceContract $smsService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SMSSendingHandlerDto $smsSendingHandlerDto, UpdateSMSSendingHandlerDto $updateSMSSendingHandlerDto): array
    {
        $this->validationService->validate($smsSendingHandlerDto->toArray(), SMSSendingHandlerDto::rules());
        $this->validationService->validate($updateSMSSendingHandlerDto->toArray(), UpdateSMSSendingHandlerDto::rules());
        return $this->smsService->updateSMSSendingHandler($smsSendingHandlerDto->getSMSSendingHandlerID(), $updateSMSSendingHandlerDto->toArray());
    }
}