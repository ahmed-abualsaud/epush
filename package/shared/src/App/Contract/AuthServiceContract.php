<?php

namespace Epush\Shared\App\Contract;

interface AuthServiceContract
{
    public function getUser(string $userID): array;

    public function addUser(array $user, string $roleName = null): array;

    public function generatePassword(string $userID): string;
}