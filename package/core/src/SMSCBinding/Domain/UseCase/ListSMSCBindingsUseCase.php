<?php

namespace Epush\Core\SMSCBinding\Domain\UseCase;

use Epush\Core\SMSCBinding\Domain\DTO\ListSMSCBindingsDto;
use Epush\Core\SMSCBinding\App\Contract\SMSCBindingServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListSMSCBindingsUseCase
{
    public function __construct(

        private SMSCBindingServiceContract $smscBindingService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListSMSCBindingsDto $listSMSCBindingsDto): array
    {
        $this->validationService->validate($listSMSCBindingsDto->toArray(), ListSMSCBindingsDto::rules());
        return $this->smscBindingService->list($listSMSCBindingsDto->getPageSize());
    }
}