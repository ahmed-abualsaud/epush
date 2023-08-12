<?php

namespace Epush\Auth\User\Infra\Database\Driver;

use Epush\Auth\User\Infra\Database\Repository\Contract\UserRepositoryContract;

class UserDatabaseDriver implements UserDatabaseDriverContract
{
    public function __construct(

        private UserRepositoryContract $userRepository

    ) {}

    public function userRepository(): UserRepositoryContract
    {
        return $this->userRepository;
    }
}