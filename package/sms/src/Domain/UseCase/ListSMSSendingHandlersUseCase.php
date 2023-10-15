<?php

namespace Epush\SMS\Domain\UseCase;

use Epush\SMS\App\Contract\SMSServiceContract;
use Epush\SMS\Domain\DTO\ListSMSSendingHandlersDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListSMSSendingHandlersUseCase
{
    public function __construct(

        private SMSServiceContract $SMSService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListSMSSendingHandlersDto $listSMSSendingHandlersDto): array
    {
        $this->validationService->validate($listSMSSendingHandlersDto->toArray(), ListSMSSendingHandlersDto::rules());
        return $this->SMSService->listSMSSendingHandlers($listSMSSendingHandlersDto->getPageSize());
    }
}