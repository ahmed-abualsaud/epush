<?php

namespace Epush\Core\MessageReport\Infra\Database\Driver;

use Epush\Core\MessageReport\Infra\Database\Repository\Contract\MessageReportRepositoryContract;

interface MessageReportDatabaseDriverContract
{
    public function messageReportRepository(): MessageReportRepositoryContract;
}