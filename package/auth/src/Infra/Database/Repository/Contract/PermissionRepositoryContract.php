<?php

namespace Epush\Auth\Infra\Database\Repository\Contract;

interface PermissionRepositoryContract
{
    public function getUserPermissions(string $userID): array;
}