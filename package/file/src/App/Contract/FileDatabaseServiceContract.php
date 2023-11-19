<?php

namespace Epush\File\App\Contract;

interface FileDatabaseServiceContract
{
    public function getFile(string $fileID): array;

    public function addFile(array $file): array;

    public function deleteFile(string $fileID): bool;

    public function updateFile(string $fileID, array $file): array;

    public function paginateFiles(int $take): array;

    public function searchFileColumn(string $column, string $value, int $take = 10): array;

    public function getFolderFiles(string $folderID): array;

    public function deleteFolderFiles(string $folderID): bool;
}