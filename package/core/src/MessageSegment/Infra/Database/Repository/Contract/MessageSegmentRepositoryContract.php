<?php

namespace Epush\Core\MessageSegment\Infra\Database\Repository\Contract;

interface MessageSegmentRepositoryContract
{
    public function all(int $take): array;

    public function insert(string $messageID, array $messageSegments): array;

    public function delete(string $messageID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}