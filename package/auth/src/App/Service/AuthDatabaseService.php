<?php

namespace Epush\Auth\App\Service;

use Epush\Auth\App\Contract\AuthDatabaseServiceContract;
use Epush\Auth\Infra\Database\Driver\AuthDatabaseDriverContract;

class AuthDatabaseService implements AuthDatabaseServiceContract
{
    public function __construct(

        private AuthDatabaseDriverContract $authDatabaseDriver

    ) {}

    public function paginateUsers(int $take): array
    {
        return $this->authDatabaseDriver->userRepository()->all($take);
    }

    public function paginateRoles(int $take): array
    {
        return $this->authDatabaseDriver->roleRepository()->all($take);
    }

    public function paginatePermissions(int $take): array
    {
        return $this->authDatabaseDriver->permissionRepository()->all($take);
    }

    public function updateUserByID(string $userID, array $data): array
    {
        return $this->authDatabaseDriver->userRepository()->updateByID($userID, $data);
    }

    public function updateUserByEmail(string $userEmail, array $data): array
    {
        return $this->authDatabaseDriver->userRepository()->updateByEmail($userEmail, $data);
    }

    public function getUserByUsername(string $username): array
    {
        return $this->authDatabaseDriver->userRepository()->getByUsername($username);
    }

    public function addUser(array $data): array
    {
        return $this->authDatabaseDriver->userRepository()->create($data);
    }

    public function deleteUser(string $userID): bool
    {
        return $this->authDatabaseDriver->userRepository()->delete($userID);
    }

    public function getUserRoles(string $userID): array
    {
        return $this->authDatabaseDriver->userRepository()->getUserRoles($userID);
    }

    public function getRolePermissions(string $roleID): array
    {
        return $this->authDatabaseDriver->roleRepository()->getRolePermissions($roleID);
    }

    public function getUserPermissions(string $userID): array
    {
        return $this->authDatabaseDriver->permissionRepository()->getUserPermissions($userID);
    }

    public function getAllUserPermissions(string $userID): array
    {
        $permissions = $this->authDatabaseDriver->permissionRepository()->getUserPermissions($userID);
        $rolesPermissions = $this->authDatabaseDriver->roleRepository()->getAllUserRolePermissions($userID);
        usort($permissions, function ($a, $b) {
            return $a['id'] - $b['id'];
        });
        usort($rolesPermissions, function ($a, $b) {
            return $a['id'] - $b['id'];
        });

        return array_replace_recursive($rolesPermissions, $permissions);
    }

    public function assignUserRoles(string $userID, array $rolesID): bool
    {
        return $this->authDatabaseDriver->userRepository()->assignRoles($userID, $rolesID);
    }

    public function assignUserRole(string $userID, string $roleName): array
    {
        return $this->authDatabaseDriver->userRepository()->assignRole($userID, $roleName);
    }

    public function unassignUserRoles(string $userID, array $rolesID): bool
    {
        return $this->authDatabaseDriver->userRepository()->unassignRoles($userID, $rolesID);
    }

    public function assignUserPermissions(string $userID, array $permissionsID): bool
    {
        return $this->authDatabaseDriver->userRepository()->assignPermissions($userID, $permissionsID);
    }

    public function unassignUserPermissions(string $userID, array $permissionsID): bool
    {
        return $this->authDatabaseDriver->userRepository()->unassignPermissions($userID, $permissionsID);
    }

    public function checkUserEnabledOrFail(string $userName): bool
    {
        return $this->authDatabaseDriver->userRepository()->checkUserEnabledOrFail($userName);
    }
    public function addRole(array $data): array
    {
        return $this->authDatabaseDriver->roleRepository()->create($data);
    }

    public function updateRole(string $roleID, array $data): array
    {
        return $this->authDatabaseDriver->roleRepository()->update($roleID, $data);
    }

    public function deleteRole(string $roleID): bool
    {
        return $this->authDatabaseDriver->roleRepository()->delete($roleID);
    }

    public function updatePermission(string $permissionID, array $data): array
    {
        return $this->authDatabaseDriver->permissionRepository()->update($permissionID, $data);
    }

    public function deletePermission(string $permissionID): bool
    {
        return $this->authDatabaseDriver->permissionRepository()->delete($permissionID);
    }

    public function assignRolePermissions(string $roleID, array $permissionsID): bool
    {
        return $this->authDatabaseDriver->roleRepository()->assignPermissions($roleID, $permissionsID);
    }

    public function unassignRolePermissions(string $roleID, array $permissionsID): bool
    {
        return $this->authDatabaseDriver->roleRepository()->unassignPermissions($roleID, $permissionsID);
    }
}