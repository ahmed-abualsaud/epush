<?php

namespace Epush\Auth\Role\Domain\UseCase;

use Epush\Auth\Role\Domain\DTO\RoleDto;
use Epush\Auth\Role\App\Contract\RoleServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Auth\Role\Domain\DTO\UnassignRolePermissionsDto;

class UnassignRolePermissionsUseCase
{
    public function __construct(

        private RoleServiceContract $roleService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(RoleDto $roleDto, UnassignRolePermissionsDto $unassignRolePermissionsDto): bool
    {
        $this->validationService->validate($roleDto->toArray(), RoleDto::rules());
        return $this->roleService->unassignRolePermissions($roleDto->getRoleId(), $unassignRolePermissionsDto->toArray());
    }
}