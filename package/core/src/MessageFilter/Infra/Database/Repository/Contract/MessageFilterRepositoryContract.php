<?php

namespace Epush\Core\MessageFilter\Infra\Database\Repository\Contract;

interface MessageFilterRepositoryContract
{
    public function all(int $take): array;

    public function get(string $messageFilterID): array;

    public function create(array $messageFilter): array;

    public function update(string $messageFilterID, array $messageFilter): array;

    public function delete(string $id): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}