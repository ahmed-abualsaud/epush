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

    public function getUserPermissions(string $id): array
    {
        return DB::transaction(function () use ($id) {

            return $this->permission->join('users_permissions', 'users_permissions.permission_id', '=', 'permissions.id')
                ->where('users_permissions.user_id', $id)
                ->get()->toArray();

        });
    }
}