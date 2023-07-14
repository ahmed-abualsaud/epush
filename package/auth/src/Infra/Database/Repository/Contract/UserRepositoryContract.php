<?php

namespace Epush\Auth\Infra\Database\Repository\Contract;

interface UserRepositoryContract
{
    public function create(array $data): array;

    public function updateByID(string $userID, array $data): array;

    public function updateByEmail(string $userEmail, array $data): array;

    public function getByUsername(string $username): array;

    public function assignRole($userID, $roleName): array;

    public function getUserRoles(string $userID): array;

}