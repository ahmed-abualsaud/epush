<?php

namespace Epush\Core\MessageReport\Infra\Database\Repository\Contract;

interface MessageClientReportRepositoryContract
{
    public function getMessageClientReports(string $userID): array;

    public function initMessageClientReports(string $userID): array;

    public function updateMessageClientReports(string $userID, int $count = 0): array;
}