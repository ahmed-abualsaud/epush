<?php

namespace Epush\Auth\User\Domain\UseCase;

use Epush\Auth\User\Domain\DTO\VerifyAccountDto;
use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class VerifyAccountUseCase
{
    public function __construct(

        private ValidationServiceContract $validationService,
        private UserServiceContract $userService

    ) {}

    public function execute(VerifyAccountDto $verifyAccountDto): array
    {
        $this->validationService->validate($verifyAccountDto->toArray(), VerifyAccountDto::rules());
        return $this->userService->verifyAccount(
            $verifyAccountDto->getEmail(),
            $verifyAccountDto->getOtp()
        );
    }
}