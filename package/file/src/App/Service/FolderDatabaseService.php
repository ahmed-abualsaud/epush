<?php

namespace Epush\File\App\Service;

use Epush\File\App\Contract\FolderDatabaseServiceContract;
use Epush\File\Infra\Database\Driver\Folder\FolderDatabaseDriverContract;

class FolderDatabaseService implements FolderDatabaseServiceContract
{
    public function __construct(

        private FolderDatabaseDriverContract $folderDatabaseDriver

    ) {}

    public function getFolder(string $folderID): array
    {
        return $this->folderDatabaseDriver->folderRepository()->get($folderID);
    }

    public function paginateFolders(int $take): array
    {
        return $this->folderDatabaseDriver->folderRepository()->all($take);
    }

    public function addFolder(array $folder): array
    {
        return $this->folderDatabaseDriver->folderRepository()->create($folder);
    }

    public function updateFolder(string $folderID, array $folder): array
    {
        return $this->folderDatabaseDriver->folderRepository()->update($folderID, $folder);
    }

    public function deleteFolder(string $folderID): bool
    {
        return $this->folderDatabaseDriver->folderRepository()->delete($folderID);
    }

    public function searchFolderColumn(string $column, string $value, int $take = 10): array
    {
        return $this->folderDatabaseDriver->folderRepository()->searchColumn($column, $value, $take);
    }
}