<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\Domain\DTO\UserDto;
use Epush\Auth\App\Contract\PermissionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetAllUserPermissionsUseCase
{
    public function __construct(

        private ValidationServiceContract $validationService,
        private PermissionServiceContract $permissionService

    ) {}

    public function execute(UserDto $userDto): array
    {
        $this->validationService->validate($userDto->toArray(), UserDto::rules());
        $permissions = $this->permissionService->getAllUserPermissions($userDto->getUserId());
        return $permissions;
    }
}