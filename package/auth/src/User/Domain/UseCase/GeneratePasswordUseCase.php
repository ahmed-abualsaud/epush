<?php

namespace Epush\Auth\User\Domain\UseCase;

use Epush\Auth\User\Domain\DTO\GeneratePasswordDto;
use Epush\Auth\User\App\Contract\CredentialsServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GeneratePasswordUseCase
{
    public function __construct(

        private ValidationServiceContract $validationService,
        private CredentialsServiceContract $credentialsService

    ) {}

    public function execute(GeneratePasswordDto $generatePasswordDto): string
    {
        $this->validationService->validate($generatePasswordDto->toArray(), GeneratePasswordDto::rules());
        return $this->credentialsService->generatePassword($generatePasswordDto->getUserID());
    }
}