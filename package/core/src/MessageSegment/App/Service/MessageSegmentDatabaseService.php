<?php

namespace Epush\Core\MessageSegment\App\Service;

use Epush\Core\MessageSegment\App\Contract\MessageSegmentDatabaseServiceContract;
use Epush\Core\MessageSegment\Infra\Database\Driver\MessageSegmentDatabaseDriverContract;

class MessageSegmentDatabaseService implements MessageSegmentDatabaseServiceContract
{
    public function __construct(

        private MessageSegmentDatabaseDriverContract $messageSegmentDatabaseDriver

    ) {}

    public function paginateMessageSegments(int $take): array
    {
        return $this->messageSegmentDatabaseDriver->messageSegmentRepository()->all($take);
    }

    public function addMessageSegments(string $messageID, array $messageSegments): array
    {
        return $this->messageSegmentDatabaseDriver->messageSegmentRepository()->insert($messageID, $messageSegments);
    }

    public function deleteMessageSegments(string $messageID): bool
    {
        return $this->messageSegmentDatabaseDriver->messageSegmentRepository()->delete($messageID);
    }

    public function searchMessageSegmentColumn(string $column, string $value, int $take = 10): array
    {
        return $this->messageSegmentDatabaseDriver->messageSegmentRepository()->searchColumn($column, $value, $take);
    }
}