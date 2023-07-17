<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\App\Contract\CredentialsServiceContract;

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