<?php

namespace Epush\Core\MessageReport\Infra\Database\Driver;

use Epush\Core\MessageReport\Infra\Database\Repository\Contract\MessageReportRepositoryContract;
use Epush\Core\MessageReport\Infra\Database\Repository\Contract\MessageClientReportRepositoryContract;

interface MessageReportDatabaseDriverContract
{
    public function messageReportRepository(): MessageReportRepositoryContract;

    public function messageClientReportRepository(): MessageClientReportRepositoryContract;
}