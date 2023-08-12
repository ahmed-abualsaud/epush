<?php

namespace Epush\Auth\Role\Infra\Database\Driver;

use Epush\Auth\Role\Infra\Database\Repository\Contract\RoleRepositoryContract;

class RoleDatabaseDriver implements RoleDatabaseDriverContract
{
    public function __construct(

        private RoleRepositoryContract $roleRepository,

    ) {}

    public function roleRepository(): RoleRepositoryContract
    {
        return $this->roleRepository;
    }
}