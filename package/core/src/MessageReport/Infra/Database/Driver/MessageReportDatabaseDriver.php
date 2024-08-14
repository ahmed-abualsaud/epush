<?php

namespace Epush\Core\MessageReport\Infra\Database\Driver;

use Epush\Core\MessageReport\Infra\Database\Repository\Contract\MessageReportRepositoryContract;

class MessageReportDatabaseDriver implements MessageReportDatabaseDriverContract
{
    public function __construct(

        private MessageReportRepositoryContract $messageReportRepository

    ) {}

    public function messageReportRepository(): MessageReportRepositoryContract
    {
        return $this->messageReportRepository;
    }
}