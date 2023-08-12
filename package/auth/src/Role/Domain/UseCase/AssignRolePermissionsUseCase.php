<?php

namespace Epush\Auth\Role\Domain\UseCase;

use Epush\Auth\Role\Domain\DTO\RoleDto;
use Epush\Auth\Role\App\Contract\RoleServiceContract;
use Epush\Auth\Role\Domain\DTO\AssignRolePermissionsDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AssignRolePermissionsUseCase
{
    public function __construct(

        private RoleServiceContract $roleService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(RoleDto $roleDto, AssignRolePermissionsDto $assignRolePermissionsDto): bool
    {
        $this->validationService->validate($roleDto->toArray(), RoleDto::rules());
        return $this->roleService->assignRolePermissions($roleDto->getRoleId(), $assignRolePermissionsDto->toArray());
    }
}