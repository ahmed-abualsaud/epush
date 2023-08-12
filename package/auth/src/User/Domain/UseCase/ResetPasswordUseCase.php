<?php

namespace Epush\Auth\User\Domain\UseCase;

use Epush\Auth\User\Domain\DTO\ResetPasswordDto;
use Epush\Auth\User\App\Contract\CredentialsServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ResetPasswordUseCase
{
    public function __construct(

        private ValidationServiceContract $validationService,
        private CredentialsServiceContract $credentialsService

    ) {}

    public function execute(ResetPasswordDto $resetPasswordDto): string
    {
        $this->validationService->validate($resetPasswordDto->toArray(), ResetPasswordDto::rules());
        $this->credentialsService->resetPassword($resetPasswordDto->getEmail(), $resetPasswordDto->getPassword());
        return 'password has been reset successfully';
    }
}