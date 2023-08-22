<?php

namespace Epush\Core\Country\App\Service;

use Epush\Core\Country\App\Contract\CountryDatabaseServiceContract;
use Epush\Core\Country\Infra\Database\Driver\CountryDatabaseDriverContract;

class CountryDatabaseService implements CountryDatabaseServiceContract
{
    public function __construct(

        private CountryDatabaseDriverContract $countryDatabaseDriver

    ) {}

    public function getCountry(string $countryID): array
    {
        return $this->countryDatabaseDriver->countryRepository()->get($countryID);
    }

    public function paginateCountries(int $take): array
    {
        return $this->countryDatabaseDriver->countryRepository()->all($take);
    }

    public function addCountry(array $country): array
    {
        return $this->countryDatabaseDriver->countryRepository()->create($country);
    }

    public function updateCountry(string $countryID, array $country): array
    {
        return $this->countryDatabaseDriver->countryRepository()->update($countryID, $country);
    }

    public function deleteCountry(string $countryID): bool
    {
        return $this->countryDatabaseDriver->countryRepository()->delete($countryID);
    }

    public function searchCountryColumn(string $column, string $value, int $take = 10): array
    {
        return $this->countryDatabaseDriver->countryRepository()->searchColumn($column, $value, $take);
    }
}