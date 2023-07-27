<?php

namespace Epush\Auth\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;
use Epush\Auth\Infra\Database\Model\Permission;
use Epush\Auth\Infra\Database\Repository\Contract\PermissionRepositoryContract;

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

    public function getUserPermissions(string $id): array
    {
        return DB::transaction(function () use ($id) {

            return $this->permission->join('users_permissions', 'users_permissions.permission_id', '=', 'permissions.id')
                ->where('users_permissions.user_id', $id)
                ->get()->toArray();

        });
    }
}