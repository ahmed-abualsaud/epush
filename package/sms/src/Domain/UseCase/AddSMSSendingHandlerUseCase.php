<?php

namespace Epush\SMS\Domain\UseCase;

use Epush\SMS\Domain\DTO\AddSMSSendingHandlerDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\SMS\App\Contract\SMSServiceContract;

class AddSMSSendingHandlerUseCase
{
    public function __construct(

        private SMSServiceContract $smsService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddSMSSendingHandlerDto $addSMSSendingHandlerDto): array
    {
        $this->validationService->validate($addSMSSendingHandlerDto->toArray(), AddSMSSendingHandlerDto::rules());
        return $this->smsService->addSMSSendingHandler($addSMSSendingHandlerDto->toArray());
    }
}