<?php

namespace Epush\Auth\User\App\Service;

use Epush\Auth\User\App\Contract\UserDatabaseServiceContract;
use Epush\Auth\User\Infra\Database\Driver\UserDatabaseDriverContract;

class UserDatabaseService implements UserDatabaseServiceContract
{
    public function __construct(

        private UserDatabaseDriverContract $userDatabaseDriver

    ) {}

    public function getUser(string $userID, bool $withHiddens = false): array
    {
        return $this->userDatabaseDriver->userRepository()->get($userID, $withHiddens);
    }

    public function getUsers(array $usersID): array
    {
        return $this->userDatabaseDriver->userRepository()->getUsers($usersID);
    }

    public function paginateUsers(int $take): array
    {
        return $this->userDatabaseDriver->userRepository()->all($take);
    }

    public function updateUserByID(string $userID, array $data): array
    {
        return $this->userDatabaseDriver->userRepository()->updateByID($userID, $data);
    }

    public function updateUserByEmail(string $userEmail, array $data): array
    {
        return $this->userDatabaseDriver->userRepository()->updateByEmail($userEmail, $data);
    }

    public function getUserByUsername(string $username): array
    {
        return $this->userDatabaseDriver->userRepository()->getByUsername($username);
    }

    public function addUser(array $data): array
    {
        return $this->userDatabaseDriver->userRepository()->create($data);
    }

    public function deleteUser(string $userID): bool
    {
        return $this->userDatabaseDriver->userRepository()->delete($userID);
    }

    public function getUserRoles(string $userID): array
    {
        return $this->userDatabaseDriver->userRepository()->getUserRoles($userID);
    }

    public function getUserPermissions(string $userID): array
    {
        return $this->userDatabaseDriver->userRepository()->getUserPermissions($userID);
    }

    public function assignUserRoles(string $userID, array $rolesID): bool
    {
        return $this->userDatabaseDriver->userRepository()->assignRoles($userID, $rolesID);
    }

    public function assignUserRole(string $userID, string $roleName): array
    {
        return $this->userDatabaseDriver->userRepository()->assignRole($userID, $roleName);
    }

    public function unassignUserRoles(string $userID, array $rolesID): bool
    {
        return $this->userDatabaseDriver->userRepository()->unassignRoles($userID, $rolesID);
    }

    public function assignUserPermissions(string $userID, array $permissionsID): bool
    {
        return $this->userDatabaseDriver->userRepository()->assignPermissions($userID, $permissionsID);
    }

    public function unassignUserPermissions(string $userID, array $permissionsID): bool
    {
        return $this->userDatabaseDriver->userRepository()->unassignPermissions($userID, $permissionsID);
    }

    public function checkUserEnabledOrFail(string $userName): bool
    {
        return $this->userDatabaseDriver->userRepository()->checkUserEnabledOrFail($userName);
    }

    public function searchUserColumn(string $column, string $value, int $take = 10, array $usersID = null): array
    {
        return $this->userDatabaseDriver->userRepository()->searchColumn($column, $value, $take, $usersID);
    }
}