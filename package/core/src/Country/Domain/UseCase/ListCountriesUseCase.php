<?php

namespace Epush\Core\Country\Domain\UseCase;

use Epush\Core\Country\Domain\DTO\ListCountriesDto;
use Epush\Core\Country\App\Contract\CountryServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListCountriesUseCase
{
    public function __construct(

        private CountryServiceContract $countryService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListCountriesDto $listCountrysDto): array
    {
        $this->validationService->validate($listCountrysDto->toArray(), ListCountriesDto::rules());
        return $this->countryService->list($listCountrysDto->getPageSize());
    }
}