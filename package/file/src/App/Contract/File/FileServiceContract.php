<?php

namespace Epush\File\App\Contract\File;

interface FileServiceContract
{
    public function localStore(string $fileAttributeName, string $fileName, string $folder): string;

    public function deleteLocalFile(string $fileName, string $folder = null): void;

    public function localeStorageBaseUrl(): string;
}