<?php

namespace Epush\Shared\App\Contract;

interface AuthServiceContract
{
    public function getUsers(array $usersID): array;

    public function getUser(string $userID): array;

    public function addUser(array $user, string $roleName = null): array;

    public function updateUser(string $userID ,array $data): array;

    public function deleteUser(string $userID): bool;

    public function generatePassword(string $userID): string;

    public function searchUserColumn(string $column, string $value, int $take = 10, array $usersID = null): array;
}