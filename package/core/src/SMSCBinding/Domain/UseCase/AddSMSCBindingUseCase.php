<?php

namespace Epush\Core\SMSCBinding\Domain\UseCase;

use Epush\Core\SMSCBinding\Domain\DTO\AddSMSCBindingDto;
use Epush\Core\SMSCBinding\App\Contract\SMSCBindingServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddSMSCBindingUseCase
{
    public function __construct(

        private SMSCBindingServiceContract $smscBindingService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddSMSCBindingDto $addSMSCBindingDto): array
    {
        $this->validationService->validate($addSMSCBindingDto->toArray(), AddSMSCBindingDto::rules());
        return $this->smscBindingService->add($addSMSCBindingDto->toArray());
    }
}