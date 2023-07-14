<?php

namespace Epush\Auth\Infra\Database\Driver;

use Epush\Auth\Infra\Database\Repository\Contract\UserRepositoryContract;
use Epush\Auth\Infra\Database\Repository\Contract\RoleRepositoryContract;
use Epush\Auth\Infra\Database\Repository\Contract\PermissionRepositoryContract;

class AuthDatabaseDriver implements AuthDatabaseDriverContract
{
    public function __construct(

        private UserRepositoryContract $userRepository,
        private RoleRepositoryContract $roleRepository,
        private PermissionRepositoryContract $permissionRepository

    ) {}

    public function userRepository(): UserRepositoryContract
    {
        return $this->userRepository;
    }

    public function roleRepository(): RoleRepositoryContract
    {
        return $this->roleRepository;
    }

    public function permissionRepository(): PermissionRepositoryContract
    {
        return $this->permissionRepository;
    }
}