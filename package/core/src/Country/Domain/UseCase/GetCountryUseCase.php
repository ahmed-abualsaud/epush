<?php

namespace Epush\Core\Country\Domain\UseCase;

use Epush\Core\Country\Domain\DTO\CountryDto;
use Epush\Core\Country\App\Contract\CountryServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetCountryUseCase
{
    public function __construct(

        private CountryServiceContract $countryService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(CountryDto $countryDto): array
    {
        $this->validationService->validate($countryDto->toArray(), CountryDto::rules());
        return $this->countryService->get($countryDto->getCountryID());
    }
}