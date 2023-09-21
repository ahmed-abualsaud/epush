<?php

namespace Epush\Core\MessageLanguage\Infra\Database\Driver;

use Epush\Core\MessageLanguage\Infra\Database\Repository\Contract\MessageLanguageRepositoryContract;

interface MessageLanguageDatabaseDriverContract
{
    public function messageLanguageRepository(): MessageLanguageRepositoryContract;
}