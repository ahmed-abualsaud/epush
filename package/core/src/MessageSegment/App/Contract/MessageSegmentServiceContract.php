<?php

namespace Epush\Core\MessageSegment\App\Contract;

interface MessageSegmentServiceContract
{
    public function list(int $take): array;

    public function add(string $messageID, array $messageSegments): array;

    public function delete(string $messageID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}