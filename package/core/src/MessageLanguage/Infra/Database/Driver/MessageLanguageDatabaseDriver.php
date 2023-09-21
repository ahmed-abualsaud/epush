<?php

namespace Epush\Core\MessageLanguage\Infra\Database\Driver;

use Epush\Core\MessageLanguage\Infra\Database\Repository\Contract\MessageLanguageRepositoryContract;

class MessageLanguageDatabaseDriver implements MessageLanguageDatabaseDriverContract
{
    public function __construct(

        private MessageLanguageRepositoryContract $messageLanguageRepository

    ) {}

    public function messageLanguageRepository(): MessageLanguageRepositoryContract
    {
        return $this->messageLanguageRepository;
    }
}