<?php

namespace Epush\Auth\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;
use Epush\Auth\Infra\Database\Model\Role;
use Epush\Auth\Infra\Database\Repository\Contract\RoleRepositoryContract;

class RoleRepository implements RoleRepositoryContract
{
    public function __construct(

        private Role $role

    ) {}

    public function getAllUserRolePermissions(string $id): array
    {
        return DB::transaction(function () use ($id) {

            return $this->role->join('users_roles', 'users_roles.role_id', '=', 'roles.id')
            ->join('roles_permissions', 'roles_permissions.role_id', '=', 'roles.id')
            ->join('permissions', 'permissions.id', '=', 'roles_permissions.permission_id')
            ->where('users_roles.user_id', $id)
                ->get()->toArray();

        });
    }
}