<?php

namespace Epush\Auth\User\Domain\UseCase;

use Epush\Auth\User\Domain\DTO\SignupDto;
use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SignupUseCase
{
    public function __construct(

        private UserServiceContract $userService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SignupDto $signupDto): array
    {
        $this->validationService->validate($signupDto->toArray(), SignupDto::rules());
        return $this->userService->signup($signupDto->toTableArray(), $signupDto->getRole());
    }
}