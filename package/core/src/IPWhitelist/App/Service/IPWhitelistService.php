<?php

namespace Epush\Core\IPWhitelist\App\Service;


use Epush\Core\IPWhitelist\App\Contract\IPWhitelistServiceContract;
use Epush\Core\IPWhitelist\App\Contract\IPWhitelistDatabaseServiceContract;

class IPWhitelistService implements IPWhitelistServiceContract
{
    public function __construct(

        private IPWhitelistDatabaseServiceContract $ipwhitelistDatabaseService

    ) {}


    public function list(int $take): array
    {
        return $this->ipwhitelistDatabaseService->paginateIPWhitelists($take);
    }

    public function get(string $ipwhitelistID): array
    {
        return $this->ipwhitelistDatabaseService->getIPWhitelist($ipwhitelistID);
    }

    public function add(array $ipwhitelist): array
    {
        return $this->ipwhitelistDatabaseService->addIPWhitelist($ipwhitelist);
    }

    public function update(string $ipwhitelistID, array $ipwhitelist): array
    {
        return $this->ipwhitelistDatabaseService->updateIPWhitelist($ipwhitelistID, $ipwhitelist);
    }

    public function delete(string $ipwhitelistID): bool
    {
        return $this->ipwhitelistDatabaseService->deleteIPWhitelist($ipwhitelistID);
    }

    public function getUserIPWhitelist(string $userID): array
    {
        return $this->ipwhitelistDatabaseService->getUserIPWhitelist($userID);
    }

    public function getUserAllowedWhitelist(string $userID): array
    {
        return $this->ipwhitelistDatabaseService->getUserAllowedWhitelist($userID);
    }
}