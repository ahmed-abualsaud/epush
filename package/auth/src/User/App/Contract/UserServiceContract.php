<?php

namespace Epush\Auth\User\App\Contract;

interface UserServiceContract
{
    public function get(string $userID): array;

    public function list(int $take): array;

    public function getUsers(array $usersID): array;

    public function update(string $userID ,array $data): array;

    public function signup(array $data, string $roleName = null): array;

    public function delete(string $userID): bool;

    public function getUserByUsername(string $username): array;

    public function checkUserEnabledOrFail(string $userName): bool;

    public function getUserRoles(string $userID): array;

    public function getUserPermissions(string $userID): array;

    public function getAllUserPermissions(string $userID): array;

    public function assignUserRoles(string $userID, array $rolesID): bool;

    public function unassignUserRoles(string $userID, array $rolesID): bool;

    public function assignUserPermissions(string $userID, array $permissionsID): bool;

    public function unassignUserPermissions(string $userID, array $permissionsID): bool;

    public function searchColumn(string $column, string $value, int $take = 10, array $usersID = null): array;

    public function forgetPassword(string $email): array;

    public function verifyAccount(string $email, $otp): array;
}