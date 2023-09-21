<?php

namespace Epush\Core\MessageSegment\App\Contract;

interface MessageSegmentDatabaseServiceContract
{
    public function addMessageSegments(string $messageID, array $messageSegments): array;

    public function paginateMessageSegments(int $take): array;

    public function deleteMessageSegments(string $messageID): bool;

    public function searchMessageSegmentColumn(string $column, string $value, int $take = 10): array;
}