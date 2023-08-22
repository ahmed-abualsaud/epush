<?php

namespace Epush\Core\SMSC\Domain\UseCase;

use Epush\Core\SMSC\Domain\DTO\SearchSMSCDto;
use Epush\Core\SMSC\App\Contract\SMSCServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchSMSCUseCase
{
    public function __construct(

        private SMSCServiceContract $smscService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchSMSCDto $searchSMSCDto): array
    {
        $this->validationService->validate($searchSMSCDto->toArray(), SearchSMSCDto::rules());
        return $this->smscService->searchColumn(
            $searchSMSCDto->getSearchColumn(),
            $searchSMSCDto->getSearchValue(),
            $searchSMSCDto->getPageSize()
        );
    }
}