<?php

namespace Epush\Core\MessageReport\Infra\Database\Repository\Contract;

interface MessageReportRepositoryContract
{
    public function all(int $take): array;

    public function get(string $messageID): array;

    public function create(array $messageReport): array;

    public function update(string $messageID, array $messageReport): array;

    public function delete(string $id): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}