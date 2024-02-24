<?php

namespace Epush\SMS\Domain\UseCase;

use Epush\SMS\Domain\DTO\ListSMSTemplatesDto;
use Epush\SMS\App\Contract\SMSServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListSMSTemplatesUseCase
{
    public function __construct(

        private SMSServiceContract $SMSService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListSMSTemplatesDto $listSMSTemplatesDto): array
    {
        $this->validationService->validate($listSMSTemplatesDto->toArray(), ListSMSTemplatesDto::rules());
        return $this->SMSService->listSMSTemplates($listSMSTemplatesDto->getUserID());
    }
}