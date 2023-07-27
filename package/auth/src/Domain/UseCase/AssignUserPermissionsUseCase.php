<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\Domain\DTO\UserDto;
use Epush\Auth\Domain\DTO\AssignUserPermissionsDto;
use Epush\Auth\App\Contract\PermissionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AssignUserPermissionsUseCase
{
    public function __construct(

        private PermissionServiceContract $permissionService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(UserDto $userDto, AssignUserPermissionsDto $assignUserPermissionsDto): bool
    {
        $this->validationService->validate($userDto->toArray(), UserDto::rules());
        return $this->permissionService->assignUserPermissions($userDto->getUserId(), $assignUserPermissionsDto->toArray());
    }
}