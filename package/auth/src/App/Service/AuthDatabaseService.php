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

    public function getUserRoles(string $userID): array
    {
        return $this->authDatabaseDriver->userRepository()->getUserRoles($userID);
    }

    public function getAllUserPermissions(string $userID): array
    {
        $permissions = $this->authDatabaseDriver->permissionRepository()->getUserPermissions($userID);
        $rolesPermissions = $this->authDatabaseDriver->roleRepository()->getAllUserRolePermissions($userID);
        return array_merge($rolesPermissions, $permissions);
    }

    public function assignUserRole(string $userID, string $roleName): array
    {
        return $this->authDatabaseDriver->userRepository()->assignRole($userID, $roleName);
    }
}