<?php

namespace Epush\Shared\App\Service;

use Epush\Auth\App\Contract\UserServiceContract;
use Epush\Shared\App\Contract\AuthServiceContract;

class AuthService implements AuthServiceContract
{
    public function __construct(

        private UserServiceContract $userService

    ) {}

    public function getUser(string $userID): array
    {
        return $this->userService->get($userID);
    }
}