<?php

namespace Epush\Core\SMSCBinding\Domain\UseCase;

use Epush\Core\SMSCBinding\Domain\DTO\SMSCBindingDto;
use Epush\Core\SMSCBinding\Domain\DTO\UpdateSMSCBindingDto;
use Epush\Core\SMSCBinding\App\Contract\SMSCBindingServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateSMSCBindingUseCase
{
    public function __construct(

        private SMSCBindingServiceContract $smscBindingService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SMSCBindingDto $smscBindingDto, UpdateSMSCBindingDto $updateSMSCBindingDto): array
    {
        $this->validationService->validate($smscBindingDto->toArray(), SMSCBindingDto::rules());
        $this->validationService->validate($updateSMSCBindingDto->toArray(), UpdateSMSCBindingDto::rules());
        return $this->smscBindingService->update($smscBindingDto->getSMSCBindingID(), $updateSMSCBindingDto->toArray());
    }
}