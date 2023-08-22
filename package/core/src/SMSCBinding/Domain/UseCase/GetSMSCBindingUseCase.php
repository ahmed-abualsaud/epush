<?php

namespace Epush\Core\SMSCBinding\Domain\UseCase;

use Epush\Core\SMSCBinding\Domain\DTO\SMSCBindingDto;
use Epush\Core\SMSCBinding\App\Contract\SMSCBindingServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetSMSCBindingUseCase
{
    public function __construct(

        private SMSCBindingServiceContract $smscBindingService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SMSCBindingDto $smscBindingDto): array
    {
        $this->validationService->validate($smscBindingDto->toArray(), SMSCBindingDto::rules());
        return $this->smscBindingService->get($smscBindingDto->getSMSCBindingID());
    }
}