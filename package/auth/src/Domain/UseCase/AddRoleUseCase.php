<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\Domain\DTO\AddRoleDto;
use Epush\Auth\App\Contract\PermissionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddRoleUseCase
{
    public function __construct(

        private PermissionServiceContract $permissionService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddRoleDto $addRoleDto): array
    {
        $this->validationService->validate($addRoleDto->toArray(), AddRoleDto::rules());
        return $this->permissionService->addRole($addRoleDto->toArray());
    }
}