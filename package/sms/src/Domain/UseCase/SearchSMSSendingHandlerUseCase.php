<?php

namespace Epush\SMS\Domain\UseCase;

use Epush\SMS\App\Contract\SMSServiceContract;
use Epush\SMS\Domain\DTO\SearchSMSSendingHandlerDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchSMSSendingHandlerUseCase
{
    public function __construct(

        private SMSServiceContract $smsSendingHandlerService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchSMSSendingHandlerDto $searchSMSSendingHandlerDto): array
    {
        $this->validationService->validate($searchSMSSendingHandlerDto->toArray(), SearchSMSSendingHandlerDto::rules());
        return $this->smsSendingHandlerService->searchSMSSendingHandlerColumn(
            $searchSMSSendingHandlerDto->getSearchColumn(),
            $searchSMSSendingHandlerDto->getSearchValue(),
            $searchSMSSendingHandlerDto->getPageSize()
        );
    }
}