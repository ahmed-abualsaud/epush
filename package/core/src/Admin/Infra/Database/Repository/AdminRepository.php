<?php

namespace Epush\Core\Admin\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\Admin\Infra\Database\Model\Admin;
use Epush\Core\Admin\Infra\Database\Repository\Contract\AdminRepositoryContract;

class AdminRepository implements AdminRepositoryContract
{
    public function __construct(

        private Admin $admin
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->admin->paginate($take)->toArray();

        });
    }

    public function get(string $userID): array
    {
        return DB::transaction(function () use ($userID) {

            $admin =  $this->admin->where('user_id', $userID)->first();
            return empty($admin) ? [] : $admin->toArray();
        });
    }
    
    public function create(array $admin): array
    {
        return DB::transaction(function () use ($admin) {

            return $this->admin->blindCreate($admin);
        });
    }

    public function delete(string $userID): bool
    {
        return DB::transaction(function () use ($userID) {

            return $this->admin->where('user_id', $userID)->delete();

        }); 
    }

    public function update(string $userID, array $data): array
    {
        return DB::transaction(function () use ($userID, $data) {

            $admin = $this->admin->where('user_id', $userID)->firstOrFail();

            if (! empty($data)) {
                $admin->update($data);
            }

            return $admin->toArray();

        }); 
    }

    public function getAdmins(array $usersID): array
    {
        return DB::transaction(function () use ($usersID) {

            return $this->admin->whereIn('user_id', $usersID)->get()->toArray();

        }); 
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            return $this->admin
                ->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
                ->paginate($take)->toArray();
        });
    }
}