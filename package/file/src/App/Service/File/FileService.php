<?php


namespace Epush\File\App\Service\File;


use Epush\File\Infra\File\FileDriverContract;
use Epush\File\App\Contract\File\FileServiceContract;

class FileService implements FileServiceContract
{

    public function __construct(

        private FileDriverContract $fileDriver

    ) {}


    public function localStore(string $fileAttributeName, string $fileName, string $folder): string
    {
        return $this->fileDriver->localStore($fileAttributeName, $fileName, $folder);
    }

    public function deleteLocalFile(string $fileName, string $folder = null): void
    {
        $this->fileDriver->deleteLocalFile($fileName, $folder);
    }

    public function localeStorageBaseUrl(): string
    {
        return $this->fileDriver->localeStorageBaseUrl();
    }
}