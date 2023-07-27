<?php

namespace Epush\File\Infra\File;

interface FileDriverContract
{
    public function localStore(string $fileAttributeName, string $folder): string;

    public function localeStorageBaseUrl(): string;
}