<?php

namespace Epush\Core\Country\Infra\Database\Repository\Contract;

interface CountryRepositoryContract
{
    public function all(int $take): array;

    public function get(string $countryID): array;

    public function create(array $country): array;

    public function update(string $countryID, array $country): array;

    public function delete(string $id): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}