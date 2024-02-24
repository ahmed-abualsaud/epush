<?php


namespace Epush\File\App\Service;

use Epush\Shared\Domain\Entity\FileDownload;

use Epush\File\Infra\PDF\PDFDriverContract;
use Epush\File\Infra\File\FileDriverContract;
use Epush\File\Infra\Excel\ExcelDriverContract;

use Epush\File\App\Contract\FileServiceContract;
use Epush\File\App\Contract\FolderServiceContract;
use Epush\File\App\Contract\FileDatabaseServiceContract;

class FileService implements FileServiceContract
{

    public function __construct(

        private PDFDriverContract $PDFDriver,
        private FileDriverContract $fileDriver,
        private ExcelDriverContract $excelDriver,
        private FolderServiceContract $folderService,
        private FileDatabaseServiceContract $fileDatabaseService

    ) {}


    public function localStore(string $fileAttributeName, string $folder, string $fileName = null): string
    {
        return $this->fileDriver->localStore($fileAttributeName, $folder, $fileName);
    }

    public function deleteLocalFile(string $fileName, string $folder = null): void
    {
        $this->fileDriver->deleteLocalFile($fileName, $folder);
    }

    public function localeStorageBaseUrl(): string
    {
        return $this->fileDriver->localeStorageBaseUrl();
    }

    public function exportExcel(array $data): FileDownload
    {
        return $this->excelDriver->download($data, 'export-'.date('Y-m-d_H:i:s').'.xlsx');
    }

    public function exportPDF(array $data): FileDownload
    {
        return $this->PDFDriver->download($data, 'export-'.date('Y-m-d_H:i:s').'.pdf');
    }

    public function list(int $take): array
    {
        return $this->fileDatabaseService->paginateFiles($take);
    }

    public function get(string $fileID): array
    {
        return $this->fileDatabaseService->getFile($fileID);
    }

    public function add(array $file): array
    {
        $folder = $this->folderService->get($file['folder_id']);
        $inputs = subAssociativeArray(['user_id', 'folder_id', 'type'], $file);
        $inputs['url'] = $this->localStore('file', $folder['name']);
        return $this->fileDatabaseService->addFile($inputs);
    }

    public function update(string $fileID, array $file): array
    {
        return $this->fileDatabaseService->updateFile($fileID, $file);
    }

    public function delete(string $fileID): bool
    {
        return $this->fileDatabaseService->deleteFile($fileID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return $this->fileDatabaseService->searchFileColumn($column, $value, $take);
    }

    public function getFolderFiles(string $folderID): array
    {
        return $this->fileDatabaseService->getFolderFiles($folderID);
    }

    public function deleteFolderFiles(string $folderID): bool
    {
        return $this->fileDatabaseService->deleteFolderFiles($folderID);
    }
}