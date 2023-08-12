<?php

namespace Epush\Auth\User\Domain\UseCase;

use Epush\Auth\User\Domain\DTO\UserDto;
use Epush\Auth\User\Domain\DTO\UnassignUserRolesDto;
use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UnassignUserRolesUseCase
{
    public function __construct(

        private UserServiceContract $userService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(UserDto $userDto, UnassignUserRolesDto $unassignUserRolesDto): bool
    {
        $this->validationService->validate($userDto->toArray(), UserDto::rules());
        return $this->userService->unassignUserRoles($userDto->getUserId(), $unassignUserRolesDto->toArray());
    }
}