<?php

namespace Epush\Auth\User\App\Contract;

interface CredentialsServiceContract
{
    public function generatePassword(string $userID): string;

    public function validateOtp(string $identifier, string $token): array;

    public function generateOtp(string $identifier): array;

    public function resetPassword(string $userEmail, string $password): void;

    public function changePassword(string $userID, string $oldPassword, string $newPassword): array;

    public function signin(string $username, string $password, bool $rememberMe = false): array;

    public function decodeToken(string $token): array;

    public function signout(): bool;

    public function getAuthenticateduser(): array;

    public function attemptOrFail(string $username, string $password): string;

    public function hashPassword(string $password): string;
}