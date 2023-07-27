<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\Domain\DTO\UserDto;
use Epush\Auth\Domain\DTO\UnassignUserRolesDto;
use Epush\Auth\App\Contract\PermissionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UnassignUserRolesUseCase
{
    public function __construct(

        private PermissionServiceContract $permissionService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(UserDto $userDto, UnassignUserRolesDto $unassignUserRolesDto): bool
    {
        $this->validationService->validate($userDto->toArray(), UserDto::rules());
        return $this->permissionService->unassignUserRoles($userDto->getUserId(), $unassignUserRolesDto->toArray());
    }
}