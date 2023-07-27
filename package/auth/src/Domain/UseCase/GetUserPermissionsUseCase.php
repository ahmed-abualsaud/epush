<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\Domain\DTO\UserDto;
use Epush\Auth\App\Contract\PermissionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetUserPermissionsUseCase
{
    public function __construct(

        private PermissionServiceContract $permissionService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(UserDto $userDto): array
    {
        $this->validationService->validate($userDto->toArray(), UserDto::rules());
        return $this->permissionService->getUserPermissions($userDto->getUserId());
    }
}