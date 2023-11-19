<?php

namespace Epush\File\Infra\Database\Driver\File;

use Epush\File\Infra\Database\Repository\Contract\FileRepositoryContract;

class FileDatabaseDriver implements FileDatabaseDriverContract
{
    public function __construct(

        private FileRepositoryContract $fileRepository

    ) {}

    public function fileRepository(): FileRepositoryContract
    {
        return $this->fileRepository;
    }
}