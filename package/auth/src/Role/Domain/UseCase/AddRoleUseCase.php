<?php

namespace Epush\Auth\Role\Domain\UseCase;

use Epush\Auth\Role\Domain\DTO\AddRoleDto;
use Epush\Auth\Role\App\Contract\RoleServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddRoleUseCase
{
    public function __construct(

        private RoleServiceContract $roleService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddRoleDto $addRoleDto): array
    {
        $this->validationService->validate($addRoleDto->toArray(), AddRoleDto::rules());
        return $this->roleService->addRole($addRoleDto->toArray());
    }
}