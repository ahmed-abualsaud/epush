<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\Domain\DTO\RoleDto;
use Epush\Auth\App\Contract\PermissionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetRolePermissionsUseCase
{
    public function __construct(

        private PermissionServiceContract $permissionService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(RoleDto $roleDto): array
    {
        $this->validationService->validate($roleDto->toArray(), RoleDto::rules());
        return $this->permissionService->getRolePermissions($roleDto->getRoleId());
    }
}