<?php


namespace Epush\Shared\App\Service;

use Epush\Shared\App\Contract\FileServiceContract;
use Epush\File\App\Contract\File\FileServiceContract as RemoteFileServiceContract;

class FileService implements FileServiceContract
{

    public function __construct(

        private RemoteFileServiceContract $fileService

    ) {}

    public function localStore(string $fileAttributeName, string $folder): string
    {
        return $this->fileService->localStore($fileAttributeName, $folder);
    }

    public function localeStorageBaseUrl(): string
    {
        return $this->fileService->localeStorageBaseUrl();
    }
}