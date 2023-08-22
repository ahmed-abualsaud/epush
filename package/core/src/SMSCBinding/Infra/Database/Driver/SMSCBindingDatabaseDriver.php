<?php

namespace Epush\Core\SMSCBinding\Infra\Database\Driver;

use Epush\Core\SMSCBinding\Infra\Database\Repository\Contract\SMSCBindingRepositoryContract;

class SMSCBindingDatabaseDriver implements SMSCBindingDatabaseDriverContract
{
    public function __construct(

        private SMSCBindingRepositoryContract $smscBindingRepository

    ) {}

    public function SMSCBindingRepository(): SMSCBindingRepositoryContract
    {
        return $this->smscBindingRepository;
    }
}