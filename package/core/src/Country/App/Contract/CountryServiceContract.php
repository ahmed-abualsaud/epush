<?php

namespace Epush\Core\Country\App\Contract;

interface CountryServiceContract
{
    public function list(int $take): array;

    public function get(string $countryID): array;

    public function add(array $country): array;

    public function update(string $countryID, array $country): array;

    public function delete(string $countryID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}