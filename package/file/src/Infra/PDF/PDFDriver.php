<?php

namespace Epush\File\Infra\PDF;

use PDF;

use ArPHP\I18N\Arabic;
use Epush\File\Domain\DTOs\DataDto;
use Epush\Shared\Present\Response;
use Epush\Shared\Present\ResponseContract;

class PDFDriver implements PDFDriverContract
{
    public function download(DataDto $data, string $fileName): ResponseContract
    {
        $reportHtml = view('file::data', $data->toArray())->render();
        
        $arabic = new Arabic();
        $p = $arabic->arIdentify($reportHtml);

        for ($i = count($p)-1; $i >= 0; $i-=2) {
            $utf8ar = $arabic->utf8Glyphs(substr($reportHtml, $p[$i-1], $p[$i] - $p[$i-1]));
            $reportHtml = substr_replace($reportHtml, $utf8ar, $p[$i-1], $p[$i] - $p[$i-1]);
        }
        $pdf = PDF::loadHTML($reportHtml);

        return new Response($pdf->download($fileName));
    }
}