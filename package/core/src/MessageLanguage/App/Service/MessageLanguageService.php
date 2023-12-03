<?php

namespace Epush\Core\MessageLanguage\App\Service;


use Epush\Core\MessageLanguage\App\Contract\MessageLanguageServiceContract;
use Epush\Core\MessageLanguage\App\Contract\MessageLanguageDatabaseServiceContract;

class MessageLanguageService implements MessageLanguageServiceContract
{
    public function __construct(

        private MessageLanguageDatabaseServiceContract $messageLanguageDatabaseService

    ) {}


    public function list(int $take): array
    {
        return $this->messageLanguageDatabaseService->paginateMessageLanguages($take);
    }

    public function get(string $messageLanguageID): array
    {
        return $this->messageLanguageDatabaseService->getMessageLanguage($messageLanguageID);
    }

    public function getByName(string $messageLanguageName): array
    {
        return $this->messageLanguageDatabaseService->getMessageLanguageByName($messageLanguageName);
    }

    public function add(array $messageLanguage): array
    {
        return $this->messageLanguageDatabaseService->addMessageLanguage($messageLanguage);
    }

    public function update(string $messageLanguageID, array $messageLanguage): array
    {
        return $this->messageLanguageDatabaseService->updateMessageLanguage($messageLanguageID, $messageLanguage);
    }

    public function delete(string $messageLanguageID): bool
    {
        return $this->messageLanguageDatabaseService->deleteMessageLanguage($messageLanguageID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return $this->messageLanguageDatabaseService->searchMessageLanguageColumn($column, $value, $take);
    }
}