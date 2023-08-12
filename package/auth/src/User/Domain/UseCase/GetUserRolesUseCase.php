<?php

namespace Epush\Auth\User\Domain\UseCase;

use Epush\Auth\User\Domain\DTO\UserDto;
use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetUserRolesUseCase
{
    public function __construct(

        private UserServiceContract $userService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(UserDto $userDto): array
    {
        $this->validationService->validate($userDto->toArray(), UserDto::rules());
        return $this->userService->getUserRoles($userDto->getUserId());
    }
}