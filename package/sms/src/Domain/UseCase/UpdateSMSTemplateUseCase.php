<?php

namespace Epush\SMS\Domain\UseCase;

use Epush\SMS\App\Contract\SMSServiceContract;
use Epush\SMS\Domain\DTO\SMSTemplateDto;
use Epush\SMS\Domain\DTO\UpdateSMSTemplateDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateSMSTemplateUseCase
{
    public function __construct(

        private SMSServiceContract $smsService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SMSTemplateDto $smsTemplateDto, UpdateSMSTemplateDto $updateSMSTemplateDto): array
    {
        $this->validationService->validate($smsTemplateDto->toArray(), SMSTemplateDto::rules());
        $this->validationService->validate($updateSMSTemplateDto->toArray(), UpdateSMSTemplateDto::rules());
        return $this->smsService->updateSMSTemplate($smsTemplateDto->getSMSTemplateID(), $updateSMSTemplateDto->toArray());
    }
}