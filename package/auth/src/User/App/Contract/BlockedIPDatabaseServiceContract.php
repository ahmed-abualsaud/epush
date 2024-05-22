<?php

namespace Epush\Auth\User\App\Contract;

interface BlockedIPDatabaseServiceContract
{
    public function addBlockedIP(array $data): array;

    public function getBlockedIP(string $ip): array;

}