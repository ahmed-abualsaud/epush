<?php

namespace Epush\Auth\User\App\Service;

use Epush\Auth\User\App\Contract\CredentialsServiceContract;
use Epush\Auth\User\App\Contract\UserDatabaseServiceContract;
use Epush\Auth\User\Infra\Credentials\CredentialsDriverContract;

class CredentialsService implements CredentialsServiceContract
{
    public function __construct(

        private CredentialsDriverContract $credentialsDriver,
        private UserDatabaseServiceContract $userDatabaseService

    ) {}

    public function generatePassword(string $userID): string
    {
        $password = $this->credentialsDriver->generatePassword();
        $hashedPassword = $this->credentialsDriver->hashPassword($password);
        $this->userDatabaseService->updateUserByID($userID, ['password' => $hashedPassword]);
        return $password;
    }

    public function resetPassword(string $userEmail, string $newPassword): void
    {
        $hashedPassword = $this->credentialsDriver->hashPassword($newPassword);
        $this->userDatabaseService->updateUserByEmail($userEmail, ['password' => $hashedPassword]);
    }

    public function signin(string $username, string $password): array
    {
        $token = $this->credentialsDriver->attemptOrFail($username, $password);
        $user = $this->credentialsDriver->getAuthenticateduser();
        $roles = $this->userDatabaseService->getUserRoles($user['id']);
        return [ 
            'user' => $user, 
            'roles' => $roles, 
            'token' => $token 
        ];
    }

    public function decodeToken(string $token): array
    {
        return $this->credentialsDriver->decodeToken($token);
    }

    public function signout(): bool
    {
        $this->credentialsDriver->signout();
        return true;
    }

    public function hashPassword(string $password): string
    {
        return $this->credentialsDriver->hashPassword($password);
    }
}