<?php

namespace Epush\Core\Country\Domain\UseCase;

use Epush\Core\Country\Domain\DTO\AddCountryDto;
use Epush\Core\Country\App\Contract\CountryServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddCountryUseCase
{
    public function __construct(

        private CountryServiceContract $countryService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddCountryDto $addCountryDto): array
    {
        $this->validationService->validate($addCountryDto->toArray(), AddCountryDto::rules());
        return $this->countryService->add($addCountryDto->toArray());
    }
}