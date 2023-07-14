<?php

namespace Epush\Auth\App\Contract;

interface PermissionServiceContract
{
    public function getUserRoles(string $userID): array;

    public function getAllUserPermissions(string $userID): array;
}