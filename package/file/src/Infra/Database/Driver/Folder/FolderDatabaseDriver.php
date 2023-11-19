<?php

namespace Epush\File\Infra\Database\Driver\Folder;

use Epush\File\Infra\Database\Repository\Contract\FolderRepositoryContract;

class FolderDatabaseDriver implements FolderDatabaseDriverContract
{
    public function __construct(

        private FolderRepositoryContract $folderRepository

    ) {}

    public function folderRepository(): FolderRepositoryContract
    {
        return $this->folderRepository;
    }
}