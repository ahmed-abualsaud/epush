<?php

namespace Epush\Core\Country\App\Contract;

interface CountryDatabaseServiceContract
{
    public function getCountry(string $countryID): array;

    public function addCountry(array $country): array;

    public function deleteCountry(string $countryID): bool;

    public function updateCountry(string $countryID, array $country): array;

    public function paginateCountries(int $take): array;

    public function searchCountryColumn(string $column, string $value, int $take = 10): array;
}