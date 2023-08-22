<?php

namespace Epush\Core\SMSCBinding\App\Service;


use Epush\Core\SMSCBinding\App\Contract\SMSCBindingServiceContract;
use Epush\Core\SMSCBinding\App\Contract\SMSCBindingDatabaseServiceContract;

class SMSCBindingService implements SMSCBindingServiceContract
{
    public function __construct(

        private SMSCBindingDatabaseServiceContract $smscBindingDatabaseService

    ) {}


    public function list(int $take): array
    {
        return $this->smscBindingDatabaseService->paginateSMSCBindings($take);
    }

    public function get(string $smscBindingID): array
    {
        return $this->smscBindingDatabaseService->getSMSCBinding($smscBindingID);
    }

    public function add(array $smscBinding): array
    {
        return $this->smscBindingDatabaseService->addSMSCBinding($smscBinding);
    }

    public function update(string $smscBindingID, array $smscBinding): array
    {
        return $this->smscBindingDatabaseService->updateSMSCBinding($smscBindingID, $smscBinding);
    }

    public function delete(string $smscBindingID): bool
    {
        return $this->smscBindingDatabaseService->deleteSMSCBinding($smscBindingID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return $this->smscBindingDatabaseService->searchSMSCBindingColumn($column, $value, $take);
    }
}