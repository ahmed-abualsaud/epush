<?php

namespace Epush\Core\SMSC\App\Contract;

interface SMSCServiceContract
{
    public function list(int $take): array;

    public function get(string $smscID): array;

    public function add(array $smsc): array;

    public function update(string $smscID, array $smsc): array;

    public function delete(string $smscID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}