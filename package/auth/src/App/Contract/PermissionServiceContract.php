<?php

namespace Epush\Auth\App\Contract;

interface PermissionServiceContract
{
    public function listRoles(int $take): array;

    public function listPermissions(int $take): array;

    public function getUserRoles(string $userID): array;

    public function getUserPermissions(string $userID): array;

    public function getRolePermissions(string $roleID): array;

    public function getAllUserPermissions(string $userID): array;

    public function assignUserRoles(string $userID, array $rolesID): bool;

    public function unassignUserRoles(string $userID, array $rolesID): bool;

    public function assignUserPermissions(string $userID, array $permissionsID): bool;

    public function unassignUserPermissions(string $userID, array $permissionsID): bool;

    public function addRole(array $data): array;

    public function updateRole(string $roleID, array $data): array;

    public function deleteRole(string $roleID): bool;

    public function updatePermission(string $permissionID, array $data): array;

    public function deletePermission(string $permissionID): bool;

    public function assignRolePermissions(string $roleID, array $permissionsID): bool;

    public function unassignRolePermissions(string $roleID, array $permissionsID): bool;
}