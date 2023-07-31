<?php

namespace Epush\Shared\App\Service;

use Epush\Auth\App\Contract\UserServiceContract;
use Epush\Shared\App\Contract\AuthServiceContract;
use Epush\Auth\App\Contract\CredentialsServiceContract;

class AuthService implements AuthServiceContract
{
    public function __construct(

        private UserServiceContract $userService,
        private CredentialsServiceContract $credentialsService

    ) {}

    public function getUser(string $userID): array
    {
        return $this->userService->get($userID);
    }

    public function addUser(array $user, string $roleName = null): array
    {
        return $this->userService->signup($user, $roleName);
    }

    public function generatePassword(string $userID): string
    {
        return $this->credentialsService->generatePassword($userID);
    }
}