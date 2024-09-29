<?php

namespace Epush\Core\MessageReport\App\Contract;

interface MessageReportServiceContract
{
    public function list(int $take): array;

    public function get(string $messageID): array;

    public function add(array $messageReport): array;

    public function update(string $messageID, array $messageReport): array;

    public function delete(string $messageID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;

    public function getMessageClientReports(string $userID): array;

    public function initMessageClientReports(string $userID): array;

    public function updateMessageClientReports(string $userID, int $count = 0): array;
}