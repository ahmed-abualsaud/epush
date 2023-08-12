<?php

namespace Epush\Auth\Permission\Infra\Database\Driver;

use Epush\Auth\Permission\Infra\Database\Repository\Contract\PermissionRepositoryContract;

interface PermissionDatabaseDriverContract
{
    public function permissionRepository(): PermissionRepositoryContract;
}