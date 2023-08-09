<?php

namespace Epush\Shared\App\Service;

use Epush\Auth\App\Contract\UserServiceContract;
use Epush\Shared\App\Contract\AuthServiceContract;
use Epush\Auth\App\Contract\CredentialsServiceContract;

class AuthService implements AuthServiceContract
{
    public function __construct(

        private UserServiceContract $userService,
        private CredentialsServiceContract $credentialsService

    ) {}


    public function getUsers(array $usersID): array
    {
        return $this->userService->getUsers($usersID);
    }

    public function getUser(string $userID): array
    {
        return $this->userService->get($userID);
    }

    public function addUser(array $user, string $roleName = null): array
    {
        return $this->userService->signup($user, $roleName);
    }

    public function updateUser(string $userID ,array $data): array
    {
        return $this->userService->update($userID, $data);
    }

    public function deleteUser(string $userID): bool
    {
        return $this->userService->delete($userID);
    }

    public function generatePassword(string $userID): string
    {
        return $this->credentialsService->generatePassword($userID);
    }

    public function searchUserColumn(string $column, string $value, int $take = 10, array $usersID = null): array
    {
        return $this->userService->searchColumn($column, $value, $take, $usersID);
    }
}