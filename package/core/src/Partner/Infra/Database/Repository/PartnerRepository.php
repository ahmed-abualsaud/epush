<?php

namespace Epush\Core\Partner\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\Partner\Infra\Database\Model\Partner;
use Epush\Core\Partner\Infra\Database\Repository\Contract\PartnerRepositoryContract;

class PartnerRepository implements PartnerRepositoryContract
{
    public function __construct(

        private Partner $partner
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $take >= 1000000000000 ?  $this->partner->paginate($take, ['*'], 'page', 1)->toArray() : 
                $this->partner->paginate($take)->toArray();

        });
    }

    public function get(string $userID): array
    {
        return DB::transaction(function () use ($userID) {

            $partner =  $this->partner->where('user_id', $userID)->first();
            return empty($partner) ? [] : $partner->toArray();
        });
    }
    
    public function create(array $partner): array
    {
        return DB::transaction(function () use ($partner) {

            return $this->partner->blindCreate($partner);
        });
    }

    public function delete(string $userID): bool
    {
        return DB::transaction(function () use ($userID) {

            return $this->partner->where('user_id', $userID)->delete();

        }); 
    }

    public function update(string $userID, array $data): array
    {
        return DB::transaction(function () use ($userID, $data) {

            $partner = $this->partner->where('user_id', $userID)->firstOrFail();

            if (! empty($data)) {
                $partner->update($data);
            }

            return $partner->toArray();

        }); 
    }

    public function getPartners(array $usersID): array
    {
        return DB::transaction(function () use ($usersID) {

            return $this->partner->whereIn('user_id', $usersID)->get()->toArray();

        }); 
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            return $this->partner
                ->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
                ->paginate($take)->toArray();
        });
    }
}