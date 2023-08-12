<?php

namespace Epush\Auth\User\Domain\UseCase;

use Epush\Auth\User\Domain\DTO\UserDto;
use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetAllUserPermissionsUseCase
{
    public function __construct(

        private ValidationServiceContract $validationService,
        private UserServiceContract $userService

    ) {}

    public function execute(UserDto $userDto): array
    {
        $this->validationService->validate($userDto->toArray(), UserDto::rules());
        return $this->userService->getAllUserPermissions($userDto->getUserId());
    }
}