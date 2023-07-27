<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\Domain\DTO\RoleDto;
use Epush\Auth\Domain\DTO\UnassignRolePermissionsDto;
use Epush\Auth\App\Contract\PermissionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UnassignRolePermissionsUseCase
{
    public function __construct(

        private PermissionServiceContract $permissionService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(RoleDto $roleDto, UnassignRolePermissionsDto $unassignRolePermissionsDto): bool
    {
        $this->validationService->validate($roleDto->toArray(), RoleDto::rules());
        return $this->permissionService->unassignRolePermissions($roleDto->getRoleId(), $unassignRolePermissionsDto->toArray());
    }
}