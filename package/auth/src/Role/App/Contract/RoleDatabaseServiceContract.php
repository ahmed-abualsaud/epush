<?php

namespace Epush\Auth\Role\App\Contract;

interface RoleDatabaseServiceContract
{
    public function paginateRoles(int $take): array;

    public function addRole(array $data): array;

    public function updateRole(string $roleID, array $data): array;

    public function deleteRole(string $roleID): bool;

    public function getRolePermissions(string $roleID): array;

    public function getRolesPermissions(array $rolesID): array;

    public function assignRolePermissions(string $roleID, array $permissionsID): bool;

    public function unassignRolePermissions(string $roleID, array $permissionsID): bool;
}