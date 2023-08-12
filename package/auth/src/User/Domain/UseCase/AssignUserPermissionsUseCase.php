<?php

namespace Epush\Auth\User\Domain\UseCase;

use Epush\Auth\User\Domain\DTO\UserDto;
use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Auth\User\Domain\DTO\AssignUserPermissionsDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AssignUserPermissionsUseCase
{
    public function __construct(

        private UserServiceContract $userService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(UserDto $userDto, AssignUserPermissionsDto $assignUserPermissionsDto): bool
    {
        $this->validationService->validate($userDto->toArray(), UserDto::rules());
        return $this->userService->assignUserPermissions($userDto->getUserId(), $assignUserPermissionsDto->toArray());
    }
}