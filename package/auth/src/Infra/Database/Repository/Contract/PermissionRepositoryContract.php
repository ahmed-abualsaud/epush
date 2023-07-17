<?php

namespace Epush\Auth\Infra\Database\Repository\Contract;

interface PermissionRepositoryContract
{
    public function all(int $take): array;

    public function getUserPermissions(string $userID): array;
}