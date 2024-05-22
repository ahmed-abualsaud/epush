<?php

namespace Epush\Auth\User\App\Service;

use Epush\Auth\User\App\Contract\BlockedIPDatabaseServiceContract;
use Epush\Auth\User\Infra\Database\Driver\UserDatabaseDriverContract;

class BlockedIPDatabaseService implements BlockedIPDatabaseServiceContract
{
    public function __construct(

        private UserDatabaseDriverContract $userDatabaseDriver

    ) {}

    public function getBlockedIP(string $ip): array
    {
        return $this->userDatabaseDriver->blockedIPRepository()->getByIP($ip);
    }

    public function addBlockedIP(array $data): array
    {
        return $this->userDatabaseDriver->blockedIPRepository()->create($data);
    }
}