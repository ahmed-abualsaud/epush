<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\Domain\DTO\UserDto;
use Epush\Auth\App\Contract\UserServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteUserUseCase
{
    public function __construct(

        private UserServiceContract $userService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(UserDto $userDto): bool
    {
        $this->validationService->validate($userDto->toArray(), UserDto::rules());
        return $this->userService->delete($userDto->getUserId());
    }
}