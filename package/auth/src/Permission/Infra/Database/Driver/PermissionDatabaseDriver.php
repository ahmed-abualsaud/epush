<?php

namespace Epush\Auth\Permission\Infra\Database\Driver;

use Epush\Auth\Permission\Infra\Database\Repository\Contract\PermissionRepositoryContract;

class PermissionDatabaseDriver implements PermissionDatabaseDriverContract
{
    public function __construct(

        private PermissionRepositoryContract $permissionRepository

    ) {}

    public function permissionRepository(): PermissionRepositoryContract
    {
        return $this->permissionRepository;
    }
}