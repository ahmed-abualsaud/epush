<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\Domain\DTO\UserDto;
use Epush\Auth\Domain\DTO\UpdateUserDto;
use Epush\Auth\App\Contract\UserServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateUserUseCase
{
    public function __construct(

        private UserServiceContract $userService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(UserDto $userDto, UpdateUserDto $updateUserDto): array
    {
        $this->validationService->validate($userDto->toArray(), UserDto::rules());
        $this->validationService->validate($updateUserDto->toArray(), UpdateUserDto::rules());
        return $this->userService->update($userDto->getUserId(), $updateUserDto->toArray());
    }
}