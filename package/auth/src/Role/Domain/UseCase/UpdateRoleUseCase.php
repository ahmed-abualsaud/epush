<?php

namespace Epush\Auth\Role\Domain\UseCase;

use Epush\Auth\Role\Domain\DTO\RoleDto;
use Epush\Auth\Role\Domain\DTO\UpdateRoleDto;
use Epush\Auth\Role\App\Contract\RoleServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateRoleUseCase
{
    public function __construct(

        private RoleServiceContract $roleService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(RoleDto $roleDto, UpdateRoleDto $updateRoleDto): array
    {
        $this->validationService->validate($roleDto->toArray(), RoleDto::rules());
        $this->validationService->validate($updateRoleDto->toArray(), UpdateRoleDto::rules());
        return $this->roleService->updateRole($roleDto->getRoleId(), $updateRoleDto->toArray());
    }
}