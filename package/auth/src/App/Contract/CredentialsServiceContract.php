<?php

namespace Epush\Auth\App\Contract;

interface CredentialsServiceContract
{
    public function generatePassword(string $userID): string;

    public function resetPassword(string $userEmail, string $password): void;

    public function signin(string $username, string $password): array;

    public function decodeToken(string $token): array;
}