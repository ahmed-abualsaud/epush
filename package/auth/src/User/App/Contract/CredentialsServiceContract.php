<?php

namespace Epush\Auth\User\App\Contract;

interface CredentialsServiceContract
{
    public function generatePassword(string $userID): string;

    public function resetPassword(string $userEmail, string $password): void;

    public function signin(string $username, string $password): array;

    public function decodeToken(string $token): array;

    public function signout(): bool;

    public function getAuthenticateduser(): array;

    public function attemptOrFail(string $username, string $password): string;

    public function hashPassword(string $password): string;
}