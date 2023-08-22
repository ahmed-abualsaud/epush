<?php

namespace Epush\Core\SMSCBinding\Domain\UseCase;

use Epush\Core\SMSCBinding\App\Contract\SMSCBindingServiceContract;
use Epush\Core\SMSCBinding\Domain\DTO\SMSCBindingDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteSMSCBindingUseCase
{
    public function __construct(

        private SMSCBindingServiceContract $smscBindingService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SMSCBindingDto $smscBindingDto): bool
    {
        $this->validationService->validate($smscBindingDto->toArray(), SMSCBindingDto::rules());
        return $this->smscBindingService->delete($smscBindingDto->getSMSCBindingID());
    }
}