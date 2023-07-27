<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\Domain\DTO\RoleDto;
use Epush\Auth\Domain\DTO\UpdateRoleDto;
use Epush\Auth\App\Contract\PermissionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateRoleUseCase
{
    public function __construct(

        private PermissionServiceContract $permissionService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(RoleDto $roleDto, UpdateRoleDto $updateRoleDto): array
    {
        $this->validationService->validate($roleDto->toArray(), RoleDto::rules());
        $this->validationService->validate($updateRoleDto->toArray(), UpdateRoleDto::rules());
        return $this->permissionService->updateRole($roleDto->getRoleId(), $updateRoleDto->toArray());
    }
}