<?php

namespace Epush\Core\MessageFilter\App\Contract;

interface MessageFilterServiceContract
{
    public function list(int $take): array;

    public function get(string $messageFilterID): array;

    public function add(array $messageFilter): array;

    public function update(string $messageFilterID, array $messageFilter): array;

    public function delete(string $messageFilterID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}