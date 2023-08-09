<?php

namespace Epush\File\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Symfony\Component\HttpFoundation\Response;

use Epush\File\Domain\DTO\DataDto;
use Epush\File\Domain\UseCase\Excel\ExportExcelUseCase;
use Epush\File\Domain\UseCase\PDF\ExportPDFUseCase;

#[Prefix('api/file/export')]
class FileExportController
{
    #[Post('pdf')]
    public function exportPDF(DataDto $dataDto, ExportPDFUseCase $exportPDFUseCase): Response
    {
        return fileDownloadResponse($exportPDFUseCase->execute($dataDto));
    }

    #[Post('excel')]
    public function exportExcel(DataDto $dataDto, ExportExcelUseCase $exportExcelUseCase): Response
    {
        return fileDownloadResponse($exportExcelUseCase->execute($dataDto));
    }
}