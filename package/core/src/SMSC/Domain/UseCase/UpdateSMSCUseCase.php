<?php

namespace Epush\Core\SMSC\Domain\UseCase;

use Epush\Core\SMSC\Domain\DTO\SMSCDto;
use Epush\Core\SMSC\Domain\DTO\UpdateSMSCDto;
use Epush\Core\SMSC\App\Contract\SMSCServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateSMSCUseCase
{
    public function __construct(

        private SMSCServiceContract $smscService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SMSCDto $smscDto, UpdateSMSCDto $updateSMSCDto): array
    {
        $this->validationService->validate($smscDto->toArray(), SMSCDto::rules());
        $this->validationService->validate($updateSMSCDto->toArray(), UpdateSMSCDto::rules());
        return $this->smscService->update($smscDto->getSMSCID(), $updateSMSCDto->toArray());
    }
}