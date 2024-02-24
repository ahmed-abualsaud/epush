<?php

namespace Epush\Core\IPWhitelist\Infra\Database\Repository\Contract;

interface IPWhitelistRepositoryContract
{
    public function all(): array;

    public function get(string $ipID): array;

    public function create(array $ip): array;

    public function update(string $ipID, array $ip): array;

    public function delete(string $id): bool;

    public function getUserIPWhitelist(string $userID): array;

    public function getUserAllowedWhitelist(string $userID): array;
}