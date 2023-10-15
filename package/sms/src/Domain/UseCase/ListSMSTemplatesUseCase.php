<?php

namespace Epush\SMS\Domain\UseCase;

use Epush\SMS\App\Contract\SMSServiceContract;

class ListSMSTemplatesUseCase
{
    public function __construct(

        private SMSServiceContract $SMSService

    ) {}

    public function execute(): array
    {
        return $this->SMSService->listSMSTemplates();
    }
}