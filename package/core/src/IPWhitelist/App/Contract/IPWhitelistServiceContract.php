<?php

namespace Epush\Core\IPWhitelist\App\Contract;

interface IPWhitelistServiceContract
{
    public function list(int $take): array;

    public function get(string $ipwhitelistID): array;

    public function add(array $ipwhitelist): array;

    public function update(string $ipwhitelistID, array $ipwhitelist): array;

    public function delete(string $ipwhitelistID): bool;

    public function getUserIPWhitelist(string $userID): array;

    public function getUserAllowedWhitelist(string $userID): array;
}