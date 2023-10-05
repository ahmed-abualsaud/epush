<?php

namespace Epush\Core\MessageFilter\Infra\Database\Driver;

use Epush\Core\MessageFilter\Infra\Database\Repository\Contract\MessageFilterRepositoryContract;

interface MessageFilterDatabaseDriverContract
{
    public function messageFilterRepository(): MessageFilterRepositoryContract;
}