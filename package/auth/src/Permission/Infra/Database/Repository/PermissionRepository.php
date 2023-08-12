<?php

namespace Epush\Auth\Permission\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;
use Epush\Auth\Permission\Infra\Database\Model\Permission;
use Epush\Auth\Permission\Infra\Database\Repository\Contract\PermissionRepositoryContract;

class PermissionRepository implements PermissionRepositoryContract
{
    public function __construct(

        private Permission $permission

    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->permission->paginate($take)->toArray();

        });
    }

    public function update(string $permissionID, array $data): array
    {
        return DB::transaction(function () use ($permissionID, $data) {

            if (! empty($data)) {
                $this->permission->where("id", $permissionID)->update($data);
            }

            return $this->permission->where('id', $permissionID)->firstOrFail()->toArray();

        });
    }

    public function delete(string $permissionID): bool
    {
        return DB::transaction(function () use ($permissionID) {

            return $this->permission->where('id', $permissionID)->delete();

        });
    }
}