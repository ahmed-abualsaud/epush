<?php

namespace Epush\Core\SMSCBinding\App\Service;

use Epush\Core\SMSCBinding\App\Contract\SMSCBindingDatabaseServiceContract;
use Epush\Core\SMSCBinding\Infra\Database\Driver\SMSCBindingDatabaseDriverContract;

class SMSCBindingDatabaseService implements SMSCBindingDatabaseServiceContract
{
    public function __construct(

        private SMSCBindingDatabaseDriverContract $smscBindingDatabaseDriver

    ) {}

    public function getSMSCBinding(string $smscBindingID): array
    {
        return $this->smscBindingDatabaseDriver->smscBindingRepository()->get($smscBindingID);
    }

    public function paginateSMSCBindings(int $take): array
    {
        return $this->smscBindingDatabaseDriver->smscBindingRepository()->all($take);
    }

    public function addSMSCBinding(array $smscBinding): array
    {
        return $this->smscBindingDatabaseDriver->smscBindingRepository()->create($smscBinding);
    }

    public function updateSMSCBinding(string $smscBindingID, array $smscBinding): array
    {
        return $this->smscBindingDatabaseDriver->smscBindingRepository()->update($smscBindingID, $smscBinding);
    }

    public function deleteSMSCBinding(string $smscBindingID): bool
    {
        return $this->smscBindingDatabaseDriver->smscBindingRepository()->delete($smscBindingID);
    }

    public function searchSMSCBindingColumn(string $column, string $value, int $take = 10): array
    {
        return $this->smscBindingDatabaseDriver->smscBindingRepository()->searchColumn($column, $value, $take);
    }
}