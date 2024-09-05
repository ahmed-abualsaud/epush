<?php

namespace Epush\Auth\User\Infra\Credentials;

interface CredentialsDriverContract
{
    public function hashPassword(string $password): string;

    public function checkPassword(string $password, string $hashedPassword): bool;

    public function validateOtp(string $identifier, string $token): array;

    public function generateOtp(string $identifier): array;

    public function generatePassword(): string;

    public function attemptOrFail(string $username, string $password, bool $rememberMe = false): string;

    public function getAuthenticatedUser(bool $signin = false): array;

    public function decodeToken(string $token): array;

    public function getRefreshToken(): string;

    public function signout(): void;
}