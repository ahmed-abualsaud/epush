<?php

namespace Epush\Auth\Role\App\Service;

use Epush\Auth\Role\App\Contract\RoleServiceContract;
use Epush\Auth\Role\App\Contract\RoleDatabaseServiceContract;

class RoleService implements RoleServiceContract
{
    public function __construct(

        private RoleDatabaseServiceContract $roleDatabaseService

    ) {}

    public function listRoles(int $take): array
    {
        return $this->roleDatabaseService->paginateRoles($take);
    }

    public function addRole(array $data): array
    {
        return $this->roleDatabaseService->addRole($data);
    }

    public function updateRole(string $roleID, array $data): array
    {
        return $this->roleDatabaseService->updateRole($roleID, $data);
    }

    public function deleteRole(string $roleID): bool
    {
        return $this->roleDatabaseService->deleteRole($roleID);
    }

    public function getRolePermissions(string $roleID): array
    {
        return $this->roleDatabaseService->getRolePermissions($roleID);
    }

    public function getRolesPermissions(array $rolesID): array
    {
        return $this->roleDatabaseService->getRolesPermissions($rolesID);
    }

    public function assignRolePermissions(string $roleID, array $permissionsID): bool
    {
        return $this->roleDatabaseService->assignRolePermissions($roleID, $permissionsID);
    }

    public function unassignRolePermissions(string $roleID, array $permissionsID): bool
    {
        return $this->roleDatabaseService->unassignRolePermissions($roleID, $permissionsID);
    }
}