<?php

namespace Epush\Core\IPWhitelist\Infra\Database\Driver;

use Epush\Core\IPWhitelist\Infra\Database\Repository\Contract\IPWhitelistRepositoryContract;

class IPWhitelistDatabaseDriver implements IPWhitelistDatabaseDriverContract
{
    public function __construct(

        private IPWhitelistRepositoryContract $iPWhitelistRepository

    ) {}

    public function ipWhitelistRepository(): IPWhitelistRepositoryContract
    {
        return $this->iPWhitelistRepository;
    }
}