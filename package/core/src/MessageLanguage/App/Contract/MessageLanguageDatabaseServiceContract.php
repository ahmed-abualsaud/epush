<?php

namespace Epush\Core\MessageLanguage\App\Contract;

interface MessageLanguageDatabaseServiceContract
{
    public function getMessageLanguage(string $messageLanguageID): array;

    public function addMessageLanguage(array $messageLanguage): array;

    public function deleteMessageLanguage(string $messageLanguageID): bool;

    public function updateMessageLanguage(string $messageLanguageID, array $messageLanguage): array;

    public function paginateMessageLanguages(int $take): array;

    public function searchMessageLanguageColumn(string $column, string $value, int $take = 10): array;
}