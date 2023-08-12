<?php

namespace Epush\Auth\User\Infra\Database\Repository\Contract;

interface UserRepositoryContract
{
    public function get(string $userID): array;

    public function all(int $take): array;

    public function create(array $data): array;

    public function delete(string $id): bool;

    public function getUsers(array $usersID): array;

    public function updateByID(string $userID, array $data): array;

    public function updateByEmail(string $userEmail, array $data): array;

    public function getByUsername(string $username): array;

    public function assignRole($userID, $roleName): array;

    public function getUserRoles(string $userID): array;

    public function getUserPermissions(string $userID): array;

    public function assignRoles(string $userID, array $rolesID): bool;

    public function unassignRoles(string $userID, array $rolesID): bool;

    public function assignPermissions(string $userID, array $permissionsID): bool;

    public function unassignPermissions(string $userID, array $permissionsID): bool;

    public function checkUserEnabledOrFail(string $userName): bool;

    public function searchColumn(string $column, string $value, int $take = 10, array $usersID = null): array;
}