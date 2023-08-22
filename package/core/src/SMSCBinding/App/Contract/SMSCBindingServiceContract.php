<?php

namespace Epush\Core\SMSCBinding\App\Contract;

interface SMSCBindingServiceContract
{
    public function list(int $take): array;

    public function get(string $smscBindingID): array;

    public function add(array $smscBinding): array;

    public function update(string $smscBindingID, array $smscBinding): array;

    public function delete(string $smscBindingID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}