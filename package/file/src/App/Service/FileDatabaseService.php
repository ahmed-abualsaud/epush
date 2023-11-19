<?php

namespace Epush\File\App\Service;

use Epush\File\App\Contract\FileDatabaseServiceContract;
use Epush\File\Infra\Database\Driver\File\FileDatabaseDriverContract;

class FileDatabaseService implements FileDatabaseServiceContract
{
    public function __construct(

        private FileDatabaseDriverContract $fileDatabaseDriver

    ) {}

    public function getFile(string $fileID): array
    {
        return $this->fileDatabaseDriver->fileRepository()->get($fileID);
    }

    public function paginateFiles(int $take): array
    {
        return $this->fileDatabaseDriver->fileRepository()->all($take);
    }

    public function addFile(array $file): array
    {
        return $this->fileDatabaseDriver->fileRepository()->create($file);
    }

    public function updateFile(string $fileID, array $file): array
    {
        return $this->fileDatabaseDriver->fileRepository()->update($fileID, $file);
    }

    public function deleteFile(string $fileID): bool
    {
        return $this->fileDatabaseDriver->fileRepository()->delete($fileID);
    }

    public function searchFileColumn(string $column, string $value, int $take = 10): array
    {
        return $this->fileDatabaseDriver->fileRepository()->searchColumn($column, $value, $take);
    }

    public function getFolderFiles(string $folderID): array
    {
        return $this->fileDatabaseDriver->fileRepository()->getFolderFiles($folderID);
    }

    public function deleteFolderFiles(string $folderID): bool
    {
        return $this->fileDatabaseDriver->fileRepository()->deleteFolderFiles($folderID);
    }
}