<?php

namespace Epush\File\App\Contract\File;

interface FileServiceContract
{
    public function localStore(string $fileAttributeName, string $folder): string;

    public function localeStorageBaseUrl(): string;
}