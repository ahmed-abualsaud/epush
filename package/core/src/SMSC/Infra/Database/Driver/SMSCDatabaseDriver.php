<?php

namespace Epush\Core\SMSC\Infra\Database\Driver;

use Epush\Core\SMSC\Infra\Database\Repository\Contract\SMSCRepositoryContract;

class SMSCDatabaseDriver implements SMSCDatabaseDriverContract
{
    public function __construct(

        private SMSCRepositoryContract $smscRepository

    ) {}

    public function smscRepository(): SMSCRepositoryContract
    {
        return $this->smscRepository;
    }
}