<?php

namespace Epush\File\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\File\Domain\DTO\FileDto;
use Epush\File\Domain\DTO\AddFileDto;
use Epush\File\Domain\DTO\ListFilesDto;
use Epush\File\Domain\DTO\SearchFileDto;
use Epush\File\Domain\DTO\UpdateFileDto;

use Epush\File\Domain\UseCase\GetFileUseCase;
use Epush\File\Domain\UseCase\AddFileUseCase;
use Epush\File\Domain\UseCase\ListFilesUseCase;
use Epush\File\Domain\UseCase\DeleteFileUseCase;
use Epush\File\Domain\UseCase\SearchFileUseCase;
use Epush\File\Domain\UseCase\UpdateFileUseCase;

use Epush\File\Domain\DTO\ExportDto;
use Epush\File\Domain\UseCase\ExportPDFUseCase;
use Epush\File\Domain\UseCase\ExportExcelUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/file')]
class FileController
{
    #[Get('/')]
    public function listFiles(ListFilesDto $listFilesDto, ListFilesUseCase $listFilesUseCase): Response
    {
        return successJSONResponse($listFilesUseCase->execute($listFilesDto));
    }

    #[Post('/')]
    public function addFile(AddFileDto $addFileDto, AddFileUseCase $addFileUseCase): Response
    {
        return successJSONResponse($addFileUseCase->execute($addFileDto));
    }

    #[Get('{file_id}')]
    public function getFile(FileDto $fileDto, GetFileUseCase $getFileUseCase): Response
    {
        return successJSONResponse($getFileUseCase->execute($fileDto));
    }

    #[Put('{file_id}')]
    public function updateFile(FileDto $fileDto, UpdateFileDto $updateFileDto, UpdateFileUseCase $updateFileUseCase): Response
    {
        return successJSONResponse($updateFileUseCase->execute($fileDto, $updateFileDto));
    }

    #[Delete('{file_id}')]
    public function deleteFile(FileDto $fileDto, DeleteFileUseCase $deleteFileUseCase): Response
    {
        return successJSONResponse($deleteFileUseCase->execute($fileDto));
    }

    #[Post('/search')]
    public function searchFileColumn(SearchFileDto $searchFileDto, SearchFileUseCase $searchFileUseCase): Response
    {
        return successJSONResponse($searchFileUseCase->execute($searchFileDto));
    }

    #[Post('export/pdf')]
    public function exportPDF(ExportDto $exportDto, ExportPDFUseCase $exportPDFUseCase): Response
    {
        return fileDownloadResponse($exportPDFUseCase->execute($exportDto));
    }

    #[Post('export/excel')]
    public function exportExcel(ExportDto $exportDto, ExportExcelUseCase $exportExcelUseCase): Response
    {
        return fileDownloadResponse($exportExcelUseCase->execute($exportDto));
    }
}