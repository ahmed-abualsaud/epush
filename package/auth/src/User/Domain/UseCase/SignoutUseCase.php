<?php

namespace Epush\Auth\User\Domain\UseCase;

use Epush\Auth\User\App\Contract\CredentialsServiceContract;

class SignoutUseCase
{
    public function __construct(

        private CredentialsServiceContract $credentialsService

    ) {}

    public function execute(): bool
    {
        return $this->credentialsService->signout();
    }
}