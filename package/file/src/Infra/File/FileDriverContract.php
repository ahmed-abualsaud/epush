<?php

namespace Epush\File\Infra\File;

interface FileDriverContract
{
    public function localStore(string $fileAttributeName, string $folder, string $fileName = null): string;

    public function deleteLocalFile(string $fileName, string $folder = null): void;

    public function localeStorageBaseUrl(): string;
}