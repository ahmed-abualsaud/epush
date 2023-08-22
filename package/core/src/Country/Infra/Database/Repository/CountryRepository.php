<?php

namespace Epush\Core\Country\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\Country\Infra\Database\Model\Country;
use Epush\Core\Country\Infra\Database\Repository\Contract\CountryRepositoryContract;

class CountryRepository implements CountryRepositoryContract
{
    public function __construct(

        private Country $country
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->country->paginate($take)->toArray();

        });
    }

    public function get(string $countryID): array
    {
        return DB::transaction(function () use ($countryID) {

            $country =  $this->country->where('id', $countryID)->first();
            return empty($country) ? [] : $country->toArray();
        });
    }
    
    public function create(array $country): array
    {
        return DB::transaction(function () use ($country) {

            return $this->country->create($country)->toArray();
        });
    }

    public function delete(string $countryID): bool
    {
        return DB::transaction(function () use ($countryID) {

            return $this->country->where('id', $countryID)->delete();

        }); 
    }

    public function update(string $countryID, array $data): array
    {
        return DB::transaction(function () use ($countryID, $data) {

            $country = $this->country->where('id', $countryID)->firstOrFail();

            if (! empty($data)) {
                $country->update($data);
            }

            return $country->toArray();

        }); 
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            return $this->country
                ->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
                ->paginate($take)->toArray();
        });
    }
}