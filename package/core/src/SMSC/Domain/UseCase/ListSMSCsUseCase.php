<?php

namespace Epush\Core\SMSC\Domain\UseCase;

use Epush\Core\SMSC\Domain\DTO\ListSMSCsDto;
use Epush\Core\SMSC\App\Contract\SMSCServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListSMSCsUseCase
{
    public function __construct(

        private SMSCServiceContract $smscService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListSMSCsDto $listSMSCsDto): array
    {
        $this->validationService->validate($listSMSCsDto->toArray(), ListSMSCsDto::rules());
        return $this->smscService->list($listSMSCsDto->getPageSize());
    }
}