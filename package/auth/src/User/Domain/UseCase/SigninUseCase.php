<?php

namespace Epush\Auth\User\Domain\UseCase;

use Epush\Auth\User\Domain\DTO\SigninDto;
use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SigninUseCase
{
    public function __construct(

        private UserServiceContract $userService,
        private ValidationServiceContract $validationService,

    ) {}

    public function execute(SigninDto $signinDto): array
    {
        $this->validationService->validate($signinDto->toArray(), SigninDto::rules());
        return $this->userService->signin(
            $signinDto->getUsername(),
            $signinDto->getPassword(),
            $signinDto->getRememberMe(),
            $signinDto->getRecaptchaToken(),
        );
    }
}