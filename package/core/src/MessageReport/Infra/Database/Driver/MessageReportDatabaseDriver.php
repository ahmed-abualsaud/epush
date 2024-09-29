<?php

namespace Epush\Core\MessageReport\Infra\Database\Driver;

use Epush\Core\MessageReport\Infra\Database\Repository\Contract\MessageReportRepositoryContract;
use Epush\Core\MessageReport\Infra\Database\Repository\Contract\MessageClientReportRepositoryContract;

class MessageReportDatabaseDriver implements MessageReportDatabaseDriverContract
{
    public function __construct(

        private MessageReportRepositoryContract $messageReportRepository,
        private MessageClientReportRepositoryContract $messageClientReportRepository

    ) {}

    public function messageReportRepository(): MessageReportRepositoryContract
    {
        return $this->messageReportRepository;
    }

    public function messageClientReportRepository(): MessageClientReportRepositoryContract
    {
        return $this->messageClientReportRepository;
    }
}