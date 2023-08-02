<?php

namespace Epush\Shared\App\Contract;

interface FileServiceContract
{
    public function localStore(string $fileAttributeName, string $fileName, string $folder): string;

    public function deleteLocalFile(string $fileName, string $folder = null): void;

    public function localeStorageBaseUrl(): string;
}