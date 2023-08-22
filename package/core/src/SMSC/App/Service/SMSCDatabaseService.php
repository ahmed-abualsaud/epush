<?php

namespace Epush\Core\SMSC\App\Service;

use Epush\Core\SMSC\App\Contract\SMSCDatabaseServiceContract;
use Epush\Core\SMSC\Infra\Database\Driver\SMSCDatabaseDriverContract;

class SMSCDatabaseService implements SMSCDatabaseServiceContract
{
    public function __construct(

        private SMSCDatabaseDriverContract $smscDatabaseDriver

    ) {}

    public function getSMSC(string $smscID): array
    {
        return $this->smscDatabaseDriver->smscRepository()->get($smscID);
    }

    public function paginateSMSCs(int $take): array
    {
        return $this->smscDatabaseDriver->smscRepository()->all($take);
    }

    public function addSMSC(array $smsc): array
    {
        return $this->smscDatabaseDriver->smscRepository()->create($smsc);
    }

    public function updateSMSC(string $smscID, array $smsc): array
    {
        return $this->smscDatabaseDriver->smscRepository()->update($smscID, $smsc);
    }

    public function deleteSMSC(string $smscID): bool
    {
        return $this->smscDatabaseDriver->smscRepository()->delete($smscID);
    }

    public function searchSMSCColumn(string $column, string $value, int $take = 10): array
    {
        return $this->smscDatabaseDriver->smscRepository()->searchColumn($column, $value, $take);
    }
}