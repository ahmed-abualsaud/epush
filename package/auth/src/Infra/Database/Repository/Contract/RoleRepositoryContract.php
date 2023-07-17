<?php

namespace Epush\Auth\Infra\Database\Repository\Contract;

interface RoleRepositoryContract
{
    public function all(int $take): array;

    public function getAllUserRolePermissions(string $userID): array;
}