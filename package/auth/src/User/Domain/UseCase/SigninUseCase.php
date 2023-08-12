<?php

namespace Epush\Auth\User\Domain\UseCase;

use Epush\Auth\User\Domain\DTO\SigninDto;
use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Auth\User\App\Contract\CredentialsServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SigninUseCase
{
    public function __construct(

        private UserServiceContract $userService,
        private ValidationServiceContract $validationService,
        private CredentialsServiceContract $credentialsService

    ) {}

    public function execute(SigninDto $signinDto): array
    {
        $this->validationService->validate($signinDto->toArray(), SigninDto::rules());
        $this->userService->checkUserEnabledOrFail($signinDto->getUsername());
        return $this->credentialsService->signin($signinDto->getUsername(), $signinDto->getPassword());
    }
}