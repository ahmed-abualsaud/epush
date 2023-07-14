<?php

namespace Epush\Shared\Domain\Entity;

class FileDownload
{
    public function __construct(private string $fileName, private string $fileContent) {}

    public function getFileName()
    {
        return $this->fileName;
    }

    public function getFileContent()
    {
        return $this->fileContent;
    }
}