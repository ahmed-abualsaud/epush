<?php

namespace Epush\Core\SMSCBinding\Infra\Database\Repository\Contract;

interface SMSCBindingRepositoryContract
{
    public function all(int $take): array;

    public function get(string $smscBindingID): array;

    public function create(array $smscBinding): array;

    public function update(string $smscBindingID, array $smscBinding): array;

    public function delete(string $id): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}