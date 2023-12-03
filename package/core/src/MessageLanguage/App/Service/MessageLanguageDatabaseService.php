<?php

namespace Epush\Core\MessageLanguage\App\Service;

use Epush\Core\MessageLanguage\App\Contract\MessageLanguageDatabaseServiceContract;
use Epush\Core\MessageLanguage\Infra\Database\Driver\MessageLanguageDatabaseDriverContract;

class MessageLanguageDatabaseService implements MessageLanguageDatabaseServiceContract
{
    public function __construct(

        private MessageLanguageDatabaseDriverContract $messageLanguageDatabaseDriver

    ) {}

    public function getMessageLanguage(string $messageLanguageID): array
    {
        return $this->messageLanguageDatabaseDriver->messageLanguageRepository()->get($messageLanguageID);
    }

    public function getMessageLanguageByName(string $messageLanguageName): array
    {
        return $this->messageLanguageDatabaseDriver->messageLanguageRepository()->getByName($messageLanguageName);
    }

    public function paginateMessageLanguages(int $take): array
    {
        return $this->messageLanguageDatabaseDriver->messageLanguageRepository()->all($take);
    }

    public function addMessageLanguage(array $messageLanguage): array
    {
        return $this->messageLanguageDatabaseDriver->messageLanguageRepository()->create($messageLanguage);
    }

    public function updateMessageLanguage(string $messageLanguageID, array $messageLanguage): array
    {
        return $this->messageLanguageDatabaseDriver->messageLanguageRepository()->update($messageLanguageID, $messageLanguage);
    }

    public function deleteMessageLanguage(string $messageLanguageID): bool
    {
        return $this->messageLanguageDatabaseDriver->messageLanguageRepository()->delete($messageLanguageID);
    }

    public function searchMessageLanguageColumn(string $column, string $value, int $take = 10): array
    {
        return $this->messageLanguageDatabaseDriver->messageLanguageRepository()->searchColumn($column, $value, $take);
    }
}