<?php

namespace Epush\Auth\Role\App\Service;

use Epush\Auth\Role\App\Contract\RoleDatabaseServiceContract;
use Epush\Auth\Role\Infra\Database\Driver\RoleDatabaseDriverContract;

class RoleDatabaseService implements RoleDatabaseServiceContract
{
    public function __construct(

        private RoleDatabaseDriverContract $roleDatabaseDriver

    ) {}

    public function paginateRoles(int $take): array
    {
        return $this->roleDatabaseDriver->roleRepository()->all($take);
    }

    public function addRole(array $data): array
    {
        return $this->roleDatabaseDriver->roleRepository()->create($data);
    }

    public function updateRole(string $roleID, array $data): array
    {
        return $this->roleDatabaseDriver->roleRepository()->update($roleID, $data);
    }

    public function deleteRole(string $roleID): bool
    {
        return $this->roleDatabaseDriver->roleRepository()->delete($roleID);
    }

    public function getRolePermissions(string $roleID): array
    {
        return $this->roleDatabaseDriver->roleRepository()->getRolePermissions($roleID);
    }

    public function getRolesPermissions(array $rolesID): array
    {
        return $this->roleDatabaseDriver->roleRepository()->getRolesPermissions($rolesID);
    }

    public function assignRolePermissions(string $roleID, array $permissionsID): bool
    {
        return $this->roleDatabaseDriver->roleRepository()->assignPermissions($roleID, $permissionsID);
    }

    public function unassignRolePermissions(string $roleID, array $permissionsID): bool
    {
        return $this->roleDatabaseDriver->roleRepository()->unassignPermissions($roleID, $permissionsID);
    }
}