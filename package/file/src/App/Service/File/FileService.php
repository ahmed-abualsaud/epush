<?php


namespace Epush\File\App\Service\File;


use Epush\File\Infra\File\FileDriverContract;
use Epush\File\App\Contract\File\FileServiceContract;

class FileService implements FileServiceContract
{

    public function __construct(

        private FileDriverContract $fileDriver

    ) {}


    public function localStore(string $fileAttributeName, string $folder): string
    {
        return $this->fileDriver->localStore($fileAttributeName, $folder);
    }

    public function localeStorageBaseUrl(): string
    {
        return $this->fileDriver->localeStorageBaseUrl();
    }
}