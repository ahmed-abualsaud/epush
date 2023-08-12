<?php

namespace Epush\Auth\Permission\App\Service;

use Epush\Auth\Permission\App\Contract\PermissionDatabaseServiceContract;
use Epush\Auth\Permission\Infra\Database\Driver\PermissionDatabaseDriverContract;

class PermissionDatabaseService implements PermissionDatabaseServiceContract
{
    public function __construct(

        private PermissionDatabaseDriverContract $permissionDatabaseDriver

    ) {}

    public function paginatePermissions(int $take): array
    {
        return $this->permissionDatabaseDriver->permissionRepository()->all($take);
    }

    public function updatePermission(string $permissionID, array $data): array
    {
        return $this->permissionDatabaseDriver->permissionRepository()->update($permissionID, $data);
    }

    public function deletePermission(string $permissionID): bool
    {
        return $this->permissionDatabaseDriver->permissionRepository()->delete($permissionID);
    }
}