<?php

namespace Epush\Core\MessageReport\Infra\Database\Repository\Contract;

interface MessageClientReportRepositoryContract
{
    public function getMessageClientReports(string $userID): array;
}