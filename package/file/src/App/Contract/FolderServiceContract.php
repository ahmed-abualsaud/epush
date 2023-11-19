<?php

namespace Epush\File\App\Contract;

interface FolderServiceContract
{
    public function list(int $take): array;

    public function get(string $folderID): array;

    public function add(array $folder): array;

    public function update(string $folderID, array $folder): array;

    public function delete(string $folderID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}