<?php

namespace Epush\Core\IPWhitelist\App\Service;

use Epush\Core\IPWhitelist\App\Contract\IPWhitelistDatabaseServiceContract;
use Epush\Core\IPWhitelist\Infra\Database\Driver\IPWhitelistDatabaseDriverContract;

class IPWhitelistDatabaseService implements IPWhitelistDatabaseServiceContract
{
    public function __construct(

        private IPWhitelistDatabaseDriverContract $ipwhitelistDatabaseDriver

    ) {}

    public function getIPWhitelist(string $ipwhitelistID): array
    {
        return $this->ipwhitelistDatabaseDriver->ipwhitelistRepository()->get($ipwhitelistID);
    }

    public function paginateIPWhitelists(int $take): array
    {
        return $this->ipwhitelistDatabaseDriver->ipwhitelistRepository()->all($take);
    }

    public function addIPWhitelist(array $ipwhitelist): array
    {
        return $this->ipwhitelistDatabaseDriver->ipwhitelistRepository()->create($ipwhitelist);
    }

    public function updateIPWhitelist(string $ipwhitelistID, array $ipwhitelist): array
    {
        return $this->ipwhitelistDatabaseDriver->ipwhitelistRepository()->update($ipwhitelistID, $ipwhitelist);
    }

    public function deleteIPWhitelist(string $ipwhitelistID): bool
    {
        return $this->ipwhitelistDatabaseDriver->ipwhitelistRepository()->delete($ipwhitelistID);
    }

    public function getUserIPWhitelist(string $userID): array
    {
        return $this->ipwhitelistDatabaseDriver->ipWhitelistRepository()->getUserIPWhitelist($userID);
    }

    public function getUserAllowedWhitelist(string $userID): array
    {
        return $this->ipwhitelistDatabaseDriver->ipWhitelistRepository()->getUserAllowedWhitelist($userID);
    }
}