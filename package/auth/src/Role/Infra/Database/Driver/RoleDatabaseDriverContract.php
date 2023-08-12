<?php

namespace Epush\Auth\Role\Infra\Database\Driver;

use Epush\Auth\Role\Infra\Database\Repository\Contract\RoleRepositoryContract;

interface RoleDatabaseDriverContract
{
    public function roleRepository(): RoleRepositoryContract;
}