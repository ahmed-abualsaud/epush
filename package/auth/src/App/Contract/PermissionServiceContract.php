<?php

namespace Epush\Auth\App\Contract;

interface PermissionServiceContract
{
    public function listRoles(int $take): array;

    public function listPermissions(int $take): array;

    public function getUserRoles(string $userID): array;

    public function getAllUserPermissions(string $userID): array;
}