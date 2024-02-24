<?php

namespace Epush\Core\IPWhitelist\Infra\Database\Driver;

use Epush\Core\IPWhitelist\Infra\Database\Repository\Contract\IPWhitelistRepositoryContract;

interface IPWhitelistDatabaseDriverContract
{
    public function ipWhitelistRepository(): IPWhitelistRepositoryContract;
}