<?php

namespace Epush\Core\Country\App\Service;


use Epush\Core\Country\App\Contract\CountryServiceContract;
use Epush\Core\Country\App\Contract\CountryDatabaseServiceContract;

use Epush\Shared\App\Contract\SMSServiceContract;
use Epush\Shared\App\Contract\AuthServiceContract;
use Epush\Shared\App\Contract\FileServiceContract;
use Epush\Shared\App\Contract\MailServiceContract;

class CountryService implements CountryServiceContract
{
    public function __construct(

        private CountryDatabaseServiceContract $countryDatabaseService

    ) {}


    public function list(int $take): array
    {
        return $this->countryDatabaseService->paginateCountries($take);
    }

    public function get(string $countryID): array
    {
        return $this->countryDatabaseService->getCountry($countryID);
    }

    public function add(array $country): array
    {
        return $this->countryDatabaseService->addCountry($country);
    }

    public function update(string $countryID, array $country): array
    {
        return $this->countryDatabaseService->updateCountry($countryID, $country);
    }

    public function delete(string $countryID): bool
    {
        return $this->countryDatabaseService->deleteCountry($countryID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return $this->countryDatabaseService->searchCountryColumn($column, $value, $take);
    }
}