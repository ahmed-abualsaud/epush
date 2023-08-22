<?php

namespace Epush\Core\SMSCBinding\Infra\Database\Driver;

use Epush\Core\SMSCBinding\Infra\Database\Repository\Contract\SMSCBindingRepositoryContract;

interface SMSCBindingDatabaseDriverContract
{
    public function smscBindingRepository(): SMSCBindingRepositoryContract;
}