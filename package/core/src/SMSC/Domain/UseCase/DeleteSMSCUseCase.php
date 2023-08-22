<?php

namespace Epush\Core\SMSC\Domain\UseCase;

use Epush\Core\SMSC\App\Contract\SMSCServiceContract;
use Epush\Core\SMSC\Domain\DTO\SMSCDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteSMSCUseCase
{
    public function __construct(

        private SMSCServiceContract $smscService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SMSCDto $smscDto): bool
    {
        $this->validationService->validate($smscDto->toArray(), SMSCDto::rules());
        return $this->smscService->delete($smscDto->getSMSCID());
    }
}