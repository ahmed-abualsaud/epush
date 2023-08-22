<?php

namespace Epush\Core\SMSC\Domain\UseCase;

use Epush\Core\SMSC\Domain\DTO\AddSMSCDto;
use Epush\Core\SMSC\App\Contract\SMSCServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddSMSCUseCase
{
    public function __construct(

        private SMSCServiceContract $smscService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddSMSCDto $addSMSCDto): array
    {
        $this->validationService->validate($addSMSCDto->toArray(), AddSMSCDto::rules());
        return $this->smscService->add($addSMSCDto->toArray());
    }
}