<?php

namespace Epush\Core\BusinessField\Infra\Database\Driver;

use Epush\Core\BusinessField\Infra\Database\Repository\Contract\BusinessFieldRepositoryContract;

interface BusinessFieldDatabaseDriverContract
{
    public function businessFieldRepository(): BusinessFieldRepositoryContract;
}