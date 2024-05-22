<?php

namespace Epush\Auth\User\Infra\Database\Repository\Contract;

interface BlockedIPRepositoryContract
{
    public function create(array $data): array;

    public function getByIP(string $ip): array;
}