<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\Domain\DTO\SignupDto;
use Epush\Auth\App\Contract\UserServiceContract;
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