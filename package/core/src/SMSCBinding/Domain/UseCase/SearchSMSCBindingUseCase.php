<?php

namespace Epush\Core\SMSCBinding\Domain\UseCase;

use Epush\Core\SMSCBinding\Domain\DTO\SearchSMSCBindingDto;
use Epush\Core\SMSCBinding\App\Contract\SMSCBindingServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchSMSCBindingUseCase
{
    public function __construct(

        private SMSCBindingServiceContract $smscBindingService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchSMSCBindingDto $searchSMSCBindingDto): array
    {
        $this->validationService->validate($searchSMSCBindingDto->toArray(), SearchSMSCBindingDto::rules());
        return $this->smscBindingService->searchColumn(
            $searchSMSCBindingDto->getSearchColumn(),
            $searchSMSCBindingDto->getSearchValue(),
            $searchSMSCBindingDto->getPageSize()
        );
    }
}