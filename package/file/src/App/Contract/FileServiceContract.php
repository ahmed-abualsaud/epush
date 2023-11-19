<?php

namespace Epush\File\App\Contract;

use Epush\Shared\Domain\Entity\FileDownload;

interface FileServiceContract
{
    public function list(int $take): array;

    public function get(string $fileID): array;

    public function add(array $file): array;

    public function update(string $fileID, array $file): array;

    public function delete(string $fileID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;

    public function getFolderFiles(string $folderID): array;

    public function localStore(string $fileAttributeName, string $folder, string $fileName = null): string;

    public function deleteLocalFile(string $fileName, string $folder = null): void;

    public function localeStorageBaseUrl(): string;

    public function exportExcel(array $data): FileDownload;

    public function exportPDF(array $data): FileDownload;
}