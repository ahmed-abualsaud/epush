<?php

namespace Epush\Auth\App\Service;

use Epush\Auth\App\Contract\AuthDatabaseServiceContract;
use Epush\Auth\App\Contract\UserServiceContract;

class UserService implements UserServiceContract
{
    public function __construct(

        private AuthDatabaseServiceContract $authDatabaseService

    ) {}

    public function signup(array $data, string $roleName): void
    {
        $user = $this->authDatabaseService->addUser($data);
        $this->authDatabaseService->assignUserRole($user['id'], $roleName);
    }
}