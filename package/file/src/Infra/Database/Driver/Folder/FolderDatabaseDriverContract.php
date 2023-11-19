<?php

namespace Epush\File\Infra\Database\Driver\Folder;

use Epush\File\Infra\Database\Repository\Contract\FolderRepositoryContract;

interface FolderDatabaseDriverContract
{
    public function folderRepository(): FolderRepositoryContract;
}