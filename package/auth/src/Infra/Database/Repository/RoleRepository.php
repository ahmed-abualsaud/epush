<?php

namespace Epush\Auth\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;
use Epush\Auth\Infra\Database\Model\Role;
use Epush\Auth\Infra\Database\Model\RolePermission;
use Epush\Auth\Infra\Database\Repository\Contract\RoleRepositoryContract;

class RoleRepository implements RoleRepositoryContract
{
    public function __construct(

        private Role $role,
        private RolePermission $rolePermission

    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->role->paginate($take)->toArray();

        });
    }

    public function create(array $data): array
    {

        return DB::transaction(function () use ($data) {

            return $this->role->blindCreate($data);

        });
    }

    public function update(string $roleID, array $data): array
    {
        return DB::transaction(function () use ($roleID, $data) {

            if (! empty($data)) {
                $this->role->where("id", $roleID)->update($data);
            }

            return $this->role->where('id', $roleID)->firstOrFail()->toArray();

        });
    }

    public function delete(string $roleID): bool
    {
        return DB::transaction(function () use ($roleID) {

            $this->rolePermission->where('role_id', $roleID)->delete();
            return $this->role->where('id', $roleID)->delete();

        });
    }

    public function assignPermissions(string $roleID, array $permissionsID): bool
    {
        return DB::transaction(function () use ($roleID, $permissionsID) {

            foreach ($permissionsID as $permissionID) {
                $input = [
                    'role_id' => $roleID, 
                    'permission_id' => $permissionID,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ];

                $this->rolePermission->updateOrCreate([
                    'role_id' => $roleID, 
                    'permission_id' => $permissionID
                ], $input);
            }

            return true;

        });
    }

    public function unassignPermissions(string $roleID, array $permissionsID): bool
    {
        return DB::transaction(function () use ($roleID, $permissionsID) {

            return $this->rolePermission->where('role_id', $roleID)->whereIn('permission_id', $permissionsID)->delete();

        });
    }

    public function getRolePermissions(string $roleID): array
    {
        return DB::transaction(function () use ($roleID) {

            return $this->role
                ->join('roles_permissions', 'roles_permissions.role_id', '=', 'roles.id')
                ->join('permissions', 'permissions.id', '=', 'roles_permissions.permission_id')
                ->where("roles.id", $roleID)
                ->get()
                ->toArray();
        });
    }

    public function getAllUserRolePermissions(string $id): array
    {
        return DB::transaction(function () use ($id) {

            return $this->role->join('users_roles', 'users_roles.role_id', '=', 'roles.id')
                ->join('roles_permissions', 'roles_permissions.role_id', '=', 'roles.id')
                ->join('permissions', 'permissions.id', '=', 'roles_permissions.permission_id')
                ->where('users_roles.user_id', $id)
                ->get()
                ->toArray();

        });
    }
}