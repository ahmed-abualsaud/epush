<?php

namespace Epush\Core\SMSC\App\Service;


use Epush\Core\SMSC\App\Contract\SMSCServiceContract;
use Epush\Core\SMSC\App\Contract\SMSCDatabaseServiceContract;


class SMSCService implements SMSCServiceContract
{
    public function __construct(

        private SMSCDatabaseServiceContract $smscDatabaseService

    ) {}


    public function list(int $take): array
    {
        return $this->smscDatabaseService->paginateSMSCs($take);
    }

    public function get(string $smscID): array
    {
        return $this->smscDatabaseService->getSMSC($smscID);
    }

    public function add(array $smsc): array
    {
        return $this->smscDatabaseService->addSMSC($smsc);
    }

    public function update(string $smscID, array $smsc): array
    {
        return $this->smscDatabaseService->updateSMSC($smscID, $smsc);
    }

    public function delete(string $smscID): bool
    {
        return $this->smscDatabaseService->deleteSMSC($smscID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return $this->smscDatabaseService->searchSMSCColumn($column, $value, $take);
    }
}