<?php

namespace Epush\Auth\User\Infra\Database\Driver;

use Epush\Auth\User\Infra\Database\Repository\Contract\UserRepositoryContract;
use Epush\Auth\User\Infra\Database\Repository\Contract\BlockedIPRepositoryContract;

class UserDatabaseDriver implements UserDatabaseDriverContract
{
    public function __construct(

        private UserRepositoryContract $userRepository,

        private BlockedIPRepositoryContract $blockedIPRepository

    ) {}

    public function userRepository(): UserRepositoryContract
    {
        return $this->userRepository;
    }

    public function blockedIPRepository(): BlockedIPRepositoryContract
    {
        return $this->blockedIPRepository;
    }

}