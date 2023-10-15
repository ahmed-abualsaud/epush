<?php

namespace Epush\SMS\Domain\UseCase;

use Epush\SMS\Domain\DTO\AddSMSTemplateDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\SMS\App\Contract\SMSServiceContract;

class AddSMSTemplateUseCase
{
    public function __construct(

        private SMSServiceContract $smsService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddSMSTemplateDto $addSMSTemplateDto): array
    {
        $this->validationService->validate($addSMSTemplateDto->toArray(), AddSMSTemplateDto::rules());
        return $this->smsService->addSMSTemplate($addSMSTemplateDto->toArray());
    }
}