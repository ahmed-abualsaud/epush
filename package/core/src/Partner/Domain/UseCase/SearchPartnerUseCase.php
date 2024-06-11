<?php

namespace Epush\Core\Partner\Domain\UseCase;

use Epush\Core\Partner\Domain\DTO\SearchPartnerDto;
use Epush\Core\Partner\App\Contract\PartnerServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchPartnerUseCase
{
    public function __construct(

        private PartnerServiceContract $partnerService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchPartnerDto $searchPartnerDto): array
    {
        $this->validationService->validate($searchPartnerDto->toArray(), SearchPartnerDto::rules());
        return $this->partnerService->searchColumn(
            $searchPartnerDto->getSearchColumn(),
            $searchPartnerDto->getSearchValue(),
            $searchPartnerDto->searchPartner(),
            $searchPartnerDto->getPageSize()
        );
    }
}