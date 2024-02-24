<?php

namespace Epush\Auth\User\Domain\UseCase;

use Epush\Auth\User\Domain\DTO\ChangePasswordDto;
use Epush\Auth\User\App\Contract\CredentialsServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ChangePasswordUseCase
{
    public function __construct(

        private ValidationServiceContract $validationService,
        private CredentialsServiceContract $credentialsService

    ) {}

    public function execute(ChangePasswordDto $changePasswordDto): array
    {
        $this->validationService->validate($changePasswordDto->toArray(), ChangePasswordDto::rules());
        return $this->credentialsService->changePassword(
            $changePasswordDto->getUserID(),
            $changePasswordDto->getOldPassword(),
            $changePasswordDto->getNewPassword()
        );
    }
}