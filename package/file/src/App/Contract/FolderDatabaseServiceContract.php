<?php

namespace Epush\File\App\Contract;

interface FolderDatabaseServiceContract
{
    public function getFolder(string $folderID): array;

    public function addFolder(array $folder): array;

    public function deleteFolder(string $folderID): bool;

    public function updateFolder(string $folderID, array $folder): array;

    public function paginateFolders(int $take): array;

    public function searchFolderColumn(string $column, string $value, int $take = 10): array;
}