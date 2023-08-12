<?php

namespace Epush\Auth\User\Domain\UseCase;

use Epush\Auth\User\Domain\DTO\UserDto;
use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Auth\User\Domain\DTO\UnassignUserPermissionsDto;

class UnassignUserPermissionsUseCase
{
    public function __construct(

        private UserServiceContract $userService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(UserDto $userDto, UnassignUserPermissionsDto $unassignUserPermissionsDto): bool
    {
        $this->validationService->validate($userDto->toArray(), UserDto::rules());
        return $this->userService->unassignUserPermissions($userDto->getUserId(), $unassignUserPermissionsDto->toArray());
    }
}