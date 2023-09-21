<?php

namespace Epush\Core\MessageSegment\Infra\Database\Driver;

use Epush\Core\MessageSegment\Infra\Database\Repository\Contract\MessageSegmentRepositoryContract;

class MessageSegmentDatabaseDriver implements MessageSegmentDatabaseDriverContract
{
    public function __construct(

        private MessageSegmentRepositoryContract $messageSegmentRepository

    ) {}

    public function messageSegmentRepository(): MessageSegmentRepositoryContract
    {
        return $this->messageSegmentRepository;
    }
}