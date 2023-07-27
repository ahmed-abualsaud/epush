<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\Domain\DTO\UserDto;
use Epush\Auth\Domain\DTO\AssignUserRolesDto;
use Epush\Auth\App\Contract\PermissionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AssignUserRolesUseCase
{
    public function __construct(

        private PermissionServiceContract $roleService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(UserDto $userDto, AssignUserRolesDto $assignUserRolesDto): bool
    {
        $this->validationService->validate($userDto->toArray(), UserDto::rules());
        return $this->roleService->assignUserRoles($userDto->getUserId(), $assignUserRolesDto->toArray());
    }
}