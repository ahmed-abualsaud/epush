<?php

namespace Epush\Core\SMSCBinding\App\Contract;

interface SMSCBindingDatabaseServiceContract
{
    public function getSMSCBinding(string $smscBindingID): array;

    public function addSMSCBinding(array $smscBinding): array;

    public function deleteSMSCBinding(string $smscBindingID): bool;

    public function updateSMSCBinding(string $smscBindingID, array $smscBinding): array;

    public function paginateSMSCBindings(int $take): array;

    public function searchSMSCBindingColumn(string $column, string $value, int $take = 10): array;
}