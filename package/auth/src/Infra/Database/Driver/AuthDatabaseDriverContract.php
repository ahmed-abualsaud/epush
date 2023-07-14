<?php

namespace Epush\Auth\Infra\Database\Driver;

use Epush\Auth\Infra\Database\Repository\Contract\UserRepositoryContract;
use Epush\Auth\Infra\Database\Repository\Contract\RoleRepositoryContract;
use Epush\Auth\Infra\Database\Repository\Contract\PermissionRepositoryContract;

interface AuthDatabaseDriverContract
{
    public function userRepository(): UserRepositoryContract;

    public function roleRepository(): RoleRepositoryContract;

    public function permissionRepository(): PermissionRepositoryContract;
}