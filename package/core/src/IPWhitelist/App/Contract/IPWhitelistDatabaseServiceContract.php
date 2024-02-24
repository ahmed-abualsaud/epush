<?php

namespace Epush\Core\IPWhitelist\App\Contract;

interface IPWhitelistDatabaseServiceContract
{
    public function getIPWhitelist(string $ipwhitelistID): array;

    public function addIPWhitelist(array $ipwhitelist): array;

    public function deleteIPWhitelist(string $ipwhitelistID): bool;

    public function updateIPWhitelist(string $ipwhitelistID, array $ipwhitelist): array;

    public function paginateIPWhitelists(int $take): array;

    public function getUserIPWhitelist(string $userID): array;

    public function getUserAllowedWhitelist(string $userID): array;
}