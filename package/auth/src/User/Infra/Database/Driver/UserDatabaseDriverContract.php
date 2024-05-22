<?php

namespace Epush\Auth\User\Infra\Database\Driver;

use Epush\Auth\User\Infra\Database\Repository\Contract\UserRepositoryContract;
use Epush\Auth\User\Infra\Database\Repository\Contract\BlockedIPRepositoryContract;

interface UserDatabaseDriverContract
{
    public function userRepository(): UserRepositoryContract;

    public function blockedIPRepository(): BlockedIPRepositoryContract;
}