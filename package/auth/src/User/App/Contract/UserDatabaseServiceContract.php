<?php

namespace Epush\Auth\User\App\Contract;

interface UserDatabaseServiceContract
{
    public function getUser(string $userID, bool $withHiddens = false): array;

    public function addUser(array $data): array;

    public function deleteUser(string $userID): bool;

    public function paginateUsers(int $take): array;

    public function getUsers(array $usersID): array;

    public function updateUserByID(string $userID, array $data): array;

    public function updateUserByEmail(string $userEmail, array $data): array;

    public function getUserByUsername(string $username): array;

    public function getUserRoles(string $userID): array;

    public function getUserPermissions(string $userID): array;

    public function assignUserRole(string $userID, string $roleName);

    public function assignUserRoles(string $userID, array $rolesID): bool;

    public function unassignUserRoles(string $userID, array $rolesID): bool;

    public function assignUserPermissions(string $userID, array $permissionsID): bool;

    public function unassignUserPermissions(string $userID, array $permissionsID): bool;

    public function checkUserEnabledOrFail(string $userName): bool;

    public function searchUserColumn(string $column, string $value, int $take = 10, array $usersID = null): array;
}