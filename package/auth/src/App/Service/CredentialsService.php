<?php

namespace Epush\Auth\App\Service;

use Epush\Auth\App\Contract\CredentialsServiceContract;
use Epush\Auth\App\Contract\AuthDatabaseServiceContract;
use Epush\Auth\Infra\Credentials\CredentialsDriverContract;

class CredentialsService implements CredentialsServiceContract
{
    public function __construct(

        private CredentialsDriverContract $credentialsDriver,
        private AuthDatabaseServiceContract $authDatabaseService

    ) {}

    public function generatePassword(string $userID): string
    {
        $password = $this->credentialsDriver->generatePassword();
        $hashedPassword = $this->credentialsDriver->hashPassword($password);
        $this->authDatabaseService->updateUserByID($userID, ['password' => $hashedPassword]);
        return $password;
    }

    public function resetPassword(string $userEmail, string $newPassword): void
    {
        $hashedPassword = $this->credentialsDriver->hashPassword($newPassword);
        $this->authDatabaseService->updateUserByEmail($userEmail, ['password' => $hashedPassword]);
    }

    public function signin(string $username, string $password): array
    {
        $token = $this->credentialsDriver->attemptOrFail($username, $password);
        $user = $this->credentialsDriver->getAuthenticateduser();
        $roles = $this->authDatabaseService->getUserRoles($user['id']);
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

}