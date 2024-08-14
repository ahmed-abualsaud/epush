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

    public function validateOtp(string $identifier, string $token): array
    {
        return $this->credentialsDriver->validateOtp($identifier, $token);
    }

    public function generateOtp(string $identifier): array
    {
        return $this->credentialsDriver->generateOtp($identifier);
    }

    public function resetPassword(string $userEmail, string $newPassword): void
    {
        $hashedPassword = $this->credentialsDriver->hashPassword($newPassword);
        $this->userDatabaseService->updateUserByEmail($userEmail, ['password' => $hashedPassword]);
    }

    public function changePassword(string $userID, string $oldPassword, string $newPassword): array
    {
        $newHashedPassword = $this->credentialsDriver->hashPassword($newPassword);
        $user = $this->userDatabaseService->getUser($userID);
        if (! $this->credentialsDriver->checkPassword($oldPassword, $user['password'])) {
            throwHttpException(400, "Your current password is invalid");
        }
        return $this->userDatabaseService->updateUserByID($userID, ['password' => $newHashedPassword]);
    }

    public function signin(string $username, string $password, bool $rememberMe = false): array
    {
        $token = $this->credentialsDriver->attemptOrFail($username, $password, $rememberMe);
        $refresh_token = $this->credentialsDriver->getRefreshToken();
        $user = $this->credentialsDriver->getAuthenticateduser();
        $roles = $this->userDatabaseService->getUserRoles($user['id']);

        if ($rememberMe) {
            $this->userDatabaseService->updateUserByID($user['id'], ['remember_token' => $refresh_token]);
        }

        return [
            'user' => $user,
            'roles' => $roles,
            'token' => $token,
            'refresh_token' => $refresh_token
        ];
    }

    public function decodeToken(string $token): array
    {
        $payload = $this->credentialsDriver->decodeToken($token);
        $payload['rmb'] = false;
        $user = $this->userDatabaseService->getUser($payload['sub'], true);
        if (! empty($user) && ! empty($user['remember_token'])) {
            $payload['rmb'] = true;
        }
        return $payload;
    }

    public function getAuthenticateduser(): array
    {
        return $this->credentialsDriver->getAuthenticateduser();
    }

    public function signout(): bool
    {
        $this->credentialsDriver->signout();
        return true;
    }

    public function attemptOrFail(string $username, string $password): string
    {
        return $this->credentialsDriver->attemptOrFail($username, $password);
    }

    public function hashPassword(string $password): string
    {
        return $this->credentialsDriver->hashPassword($password);
    }
}