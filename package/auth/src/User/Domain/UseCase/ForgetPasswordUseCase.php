<?php

namespace Epush\Auth\User\Domain\UseCase;

use Epush\Auth\User\Domain\DTO\ForgetPasswordDto;
use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ForgetPasswordUseCase
{
    public function __construct(

        private ValidationServiceContract $validationService,
        private UserServiceContract $userService

    ) {}

    public function execute(ForgetPasswordDto $forgetPasswordDto): array
    {
        $this->validationService->validate($forgetPasswordDto->toArray(), ForgetPasswordDto::rules());
        return $this->userService->forgetPassword(
            $forgetPasswordDto->getEmail()
        );
    }
}