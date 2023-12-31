<?php

namespace Epush\Auth\User\Infra\Credentials;

interface CredentialsDriverContract
{
    public function hashPassword(string $password): string;

    public function generatePassword(): string;

    public function attemptOrFail(string $username, string $password): string;

    public function getAuthenticatedUser(): array;

    public function decodeToken(string $token): array;

    public function signout(): void;
}