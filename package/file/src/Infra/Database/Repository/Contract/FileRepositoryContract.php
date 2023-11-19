<?php

namespace Epush\File\Infra\Database\Repository\Contract;

interface FileRepositoryContract
{
    public function all(int $take): array;

    public function get(string $folderID): array;

    public function create(array $folder): array;

    public function update(string $folderID, array $folder): array;

    public function delete(string $id): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;

    public function getFolderFiles(string $folderID): array;

    public function deleteFolderFiles(string $folderID): bool;
}