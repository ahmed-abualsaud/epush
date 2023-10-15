<?php

namespace Epush\SMS\Domain\UseCase;

use Epush\SMS\Domain\DTO\SMSTemplateDto;
use Epush\SMS\App\Contract\SMSServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteSMSTemplateUseCase
{
    public function __construct(

        private SMSServiceContract $smsService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SMSTemplateDto $smsTemplateDto): bool
    {
        $this->validationService->validate($smsTemplateDto->toArray(), SMSTemplateDto::rules());
        return $this->smsService->deleteSMSTemplate($smsTemplateDto->getSMSTemplateID());
    }
}