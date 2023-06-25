<?php

namespace Epush\File\Present\Http\Controllers;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Prefix;

use Epush\Shared\Present\Response;
use Epush\File\Domain\DTOs\DataDto;
use Epush\File\Domain\UseCases\Excel\ExportExcelUseCase;
use Epush\File\Domain\UseCases\PDF\ExportPDFUseCase;

#[Prefix('api/export')]
class FileExportController
{
    #[Get('pdf')]
    public function exportPDF(DataDto $dataDto, ExportPDFUseCase $exportPDFUseCase): Response
    {
        return $exportPDFUseCase->execute($dataDto);
    }

    #[Get('excel')]
    public function exportExcel(DataDto $dataDto, ExportExcelUseCase $exportExcelUseCase): Response
    {
        return $exportExcelUseCase->execute($dataDto);
    }
}