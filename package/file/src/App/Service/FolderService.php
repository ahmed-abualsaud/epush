<?php

namespace Epush\File\App\Service;

use Epush\File\App\Contract\FolderServiceContract;
use Epush\File\App\Contract\FileDatabaseServiceContract;
use Epush\File\App\Contract\FolderDatabaseServiceContract;

class FolderService implements FolderServiceContract
{
    public function __construct(

        private FileDatabaseServiceContract $fileDatabaseService,
        private FolderDatabaseServiceContract $folderDatabaseService

    ) {}


    public function list(int $take): array
    {
        return $this->folderDatabaseService->paginateFolders($take);
    }

    public function get(string $folderID): array
    {
        return $this->folderDatabaseService->getFolder($folderID);
    }

    public function add(array $folder): array
    {
        return $this->folderDatabaseService->addFolder($folder);
    }

    public function update(string $folderID, array $folder): array
    {
        return $this->folderDatabaseService->updateFolder($folderID, $folder);
    }

    public function delete(string $folderID): bool
    {
        $files = $this->fileDatabaseService->deleteFolderFiles($folderID);
        $folder = $this->folderDatabaseService->deleteFolder($folderID);
        return $files && $folder;
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return $this->folderDatabaseService->searchFolderColumn($column, $value, $take);
    }
}