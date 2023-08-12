<?php

namespace Epush\Auth\Permission\App\Contract;

interface PermissionDatabaseServiceContract
{
    public function paginatePermissions(int $take): array;

    public function updatePermission(string $permissionID, array $data): array;

    public function deletePermission(string $permissionID): bool;
}