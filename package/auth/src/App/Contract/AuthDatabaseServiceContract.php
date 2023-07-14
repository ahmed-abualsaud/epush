<?php

namespace Epush\Auth\App\Contract;

interface AuthDatabaseServiceContract
{
    public function updateUserByID(string $userID, array $data): array;

    public function updateUserByEmail(string $userEmail, array $data): array;

    public function getUserByUsername(string $username): array;

    public function addUser(array $data): array;

    public function getUserRoles(string $userID): array;

    public function getAllUserPermissions(string $userID): array;

    public function assignUserRole(string $userID, string $roleName);
}