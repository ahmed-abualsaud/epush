<?php

namespace Epush\Core\SMSC\Infra\Database\Repository\Contract;

interface SMSCRepositoryContract
{
    public function all(int $take): array;

    public function get(string $smscID): array;

    public function create(array $smsc): array;

    public function update(string $smscID, array $smsc): array;

    public function delete(string $id): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}