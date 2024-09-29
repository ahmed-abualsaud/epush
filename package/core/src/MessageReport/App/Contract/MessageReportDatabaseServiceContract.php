<?php

namespace Epush\Core\MessageReport\App\Contract;

interface MessageReportDatabaseServiceContract
{
    public function getMessageReport(string $messageID): array;

    public function addMessageReport(array $messageReport): array;

    public function deleteMessageReport(string $messageID): bool;

    public function updateMessageReport(string $messageID, array $messageReport): array;

    public function paginateMessageReports(int $take): array;

    public function searchMessageReportColumn(string $column, string $value, int $take = 10): array;

    public function getMessageClientReports(string $userID): array;

    public function initMessageClientReports(string $userID): array;

    public function updateMessageClientReports(string $userID, int $count = 0): int;
}