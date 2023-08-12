<?php

namespace Epush\Auth\Permission\App\Contract;

interface PermissionServiceContract
{
    public function listPermissions(int $take): array;

    public function updatePermission(string $permissionID, array $data): array;

    public function deletePermission(string $permissionID): bool;
}