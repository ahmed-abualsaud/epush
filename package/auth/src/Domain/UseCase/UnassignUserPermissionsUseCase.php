<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\Domain\DTO\UserDto;
use Epush\Auth\Domain\DTO\UnassignUserPermissionsDto;
use Epush\Auth\App\Contract\PermissionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UnassignUserPermissionsUseCase
{
    public function __construct(

        private PermissionServiceContract $permissionService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(UserDto $userDto, UnassignUserPermissionsDto $unassignUserPermissionsDto): bool
    {
        $this->validationService->validate($userDto->toArray(), UserDto::rules());
        return $this->permissionService->unassignUserPermissions($userDto->getUserId(), $unassignUserPermissionsDto->toArray());
    }
}