<?php

namespace Epush\Core\Country\Domain\UseCase;

use Epush\Core\Country\Domain\DTO\SearchCountryDto;
use Epush\Core\Country\App\Contract\CountryServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchCountryUseCase
{
    public function __construct(

        private CountryServiceContract $countryService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchCountryDto $searchCountryDto): array
    {
        $this->validationService->validate($searchCountryDto->toArray(), SearchCountryDto::rules());
        return $this->countryService->searchColumn(
            $searchCountryDto->getSearchColumn(),
            $searchCountryDto->getSearchValue(),
            $searchCountryDto->getPageSize()
        );
    }
}