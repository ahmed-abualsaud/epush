<?php

namespace Epush\Auth\Permission\App\Service;

use Epush\Shared\App\Contract\OrchiServiceContract;
use Epush\Auth\Permission\App\Contract\PermissionServiceContract;
use Epush\Auth\Permission\App\Contract\PermissionDatabaseServiceContract;

class PermissionService implements PermissionServiceContract
{
    public function __construct(

        private OrchiServiceContract $orchiService,
        private PermissionDatabaseServiceContract $permissionDatabaseService

    ) {}

    public function listPermissions(int $take): array
    {
        return $this->permissionDatabaseService->paginatePermissions($take);
    }

    public function updatePermission(string $permissionID, array $data): array
    {
        return $this->permissionDatabaseService->updatePermission($permissionID, $data);
    }

    public function deletePermission(string $permissionID): bool
    {
        return $this->permissionDatabaseService->deletePermission($permissionID);
    }
}