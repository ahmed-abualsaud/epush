<?php

namespace Epush\Auth\Infra\Database\Repository\Contract;

interface RoleRepositoryContract
{
    public function all(int $take): array;

    public function create(array $data): array;

    public function update(string $roleID, array $data): array;

    public function delete(string $roleID): bool;

    public function getRolePermissions(string $roleID): array;

    public function assignPermissions(string $roleID, array $permissionsID): bool;

    public function unassignPermissions(string $roleID, array $permissionsID): bool;

    public function getAllUserRolePermissions(string $userID): array;
}