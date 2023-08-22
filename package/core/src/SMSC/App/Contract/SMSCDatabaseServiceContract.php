<?php

namespace Epush\Core\SMSC\App\Contract;

interface SMSCDatabaseServiceContract
{
    public function getSMSC(string $smscID): array;

    public function addSMSC(array $smsc): array;

    public function deleteSMSC(string $smscID): bool;

    public function updateSMSC(string $smscID, array $smsc): array;

    public function paginateSMSCs(int $take): array;

    public function searchSMSCColumn(string $column, string $value, int $take = 10): array;
}