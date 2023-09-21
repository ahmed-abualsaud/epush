<?php

namespace Epush\Core\MessageSegment\App\Service;


use Epush\Core\MessageSegment\App\Contract\MessageSegmentServiceContract;
use Epush\Core\MessageSegment\App\Contract\MessageSegmentDatabaseServiceContract;

class MessageSegmentService implements MessageSegmentServiceContract
{
    public function __construct(

        private MessageSegmentDatabaseServiceContract $messageSegmentDatabaseService

    ) {}


    public function list(int $take): array
    {
        return $this->messageSegmentDatabaseService->paginateMessageSegments($take);
    }

    public function add(string $messageID, array $messageSegments): array
    {
        return $this->messageSegmentDatabaseService->addMessageSegments($messageID, $messageSegments);
    }

    public function delete(string $messageID): bool
    {
        return $this->messageSegmentDatabaseService->deleteMessageSegments($messageID);
    }


    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return $this->messageSegmentDatabaseService->searchMessageSegmentColumn($column, $value, $take);
    }
}