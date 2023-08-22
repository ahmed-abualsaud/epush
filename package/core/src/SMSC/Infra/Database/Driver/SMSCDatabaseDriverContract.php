<?php

namespace Epush\Core\SMSC\Infra\Database\Driver;

use Epush\Core\SMSC\Infra\Database\Repository\Contract\SMSCRepositoryContract;

interface SMSCDatabaseDriverContract
{
    public function smscRepository(): SMSCRepositoryContract;
}