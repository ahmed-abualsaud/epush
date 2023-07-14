<?php

namespace Epush\Auth\Infra\Database\Repository\Contract;

interface RoleRepositoryContract
{
    public function getAllUserRolePermissions(string $userID): array;
}