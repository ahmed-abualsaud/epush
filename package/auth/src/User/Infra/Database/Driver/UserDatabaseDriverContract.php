<?php

namespace Epush\Auth\User\Infra\Database\Driver;

use Epush\Auth\User\Infra\Database\Repository\Contract\UserRepositoryContract;

interface UserDatabaseDriverContract
{
    public function userRepository(): UserRepositoryContract;
}