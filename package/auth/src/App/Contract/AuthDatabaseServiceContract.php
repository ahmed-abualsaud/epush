<?php

namespace Epush\Auth\App\Contract;

interface AuthDatabaseServiceContract
{
    public function getUser(string $userID): array;

    public function addUser(array $data): array;

    public function deleteUser(string $userID): bool;

    public function paginateUsers(int $take): array;

    public function paginateRoles(int $take): array;

    public function paginatePermissions(int $take): array;

    public function updateUserByID(string $userID, array $data): array;

    public function updateUserByEmail(string $userEmail, array $data): array;

    public function getUserByUsername(string $username): array;

    public function getUserRoles(string $userID): array;

    public function getRolePermissions(string $roleID): array;

    public function getUserPermissions(string $userID): array;

    public function getAllUserPermissions(string $userID): array;

    public function assignUserRole(string $userID, string $roleName);

    public function assignUserRoles(string $userID, array $rolesID): bool;

    public function unassignUserRoles(string $userID, array $rolesID): bool;

    public function assignUserPermissions(string $userID, array $permissionsID): bool;

    public function unassignUserPermissions(string $userID, array $permissionsID): bool;

    public function checkUserEnabledOrFail(string $userName): bool;

    public function addRole(array $data): array;

    public function updateRole(string $roleID, array $data): array;

    public function deleteRole(string $roleID): bool;

    public function updatePermission(string $permissionID, array $data): array;

    public function deletePermission(string $permissionID): bool;

    public function assignRolePermissions(string $roleID, array $permissionsID): bool;

    public function unassignRolePermissions(string $roleID, array $permissionsID): bool;
}