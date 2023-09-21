<?php

namespace Epush\Core\MessageSegment\Infra\Database\Driver;

use Epush\Core\MessageSegment\Infra\Database\Repository\Contract\MessageSegmentRepositoryContract;

interface MessageSegmentDatabaseDriverContract
{
    public function messageSegmentRepository(): MessageSegmentRepositoryContract;
}