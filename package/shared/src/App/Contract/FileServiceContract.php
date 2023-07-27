<?php

namespace Epush\Shared\App\Contract;

interface FileServiceContract
{
    public function localStore(string $fileAttributeName, string $folder): string;

    public function localeStorageBaseUrl(): string;
}