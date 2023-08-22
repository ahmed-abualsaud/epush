<?php

namespace Epush\Core\Country\Domain\UseCase;

use Epush\Core\Country\Domain\DTO\CountryDto;
use Epush\Core\Country\Domain\DTO\UpdateCountryDto;
use Epush\Core\Country\App\Contract\CountryServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateCountryUseCase
{
    public function __construct(

        private CountryServiceContract $countryService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(CountryDto $countryDto, UpdateCountryDto $updateCountryDto): array
    {
        $this->validationService->validate($countryDto->toArray(), CountryDto::rules());
        $this->validationService->validate($updateCountryDto->toArray(), UpdateCountryDto::rules());
        return $this->countryService->update($countryDto->getCountryID(), $updateCountryDto->toArray());
    }
}