<?php

namespace Epush\File\Infra\PDF;

use PDF;

use ArPHP\I18N\Arabic;
use Epush\Shared\Domain\Entity\FileDownload;

class PDFDriver implements PDFDriverContract
{
    public function download(array $data, string $fileName): FileDownload
    {
        $reportHtml = view('file::data', $data)->render();
        
        $arabic = new Arabic();
        $p = $arabic->arIdentify($reportHtml);

        for ($i = count($p)-1; $i >= 0; $i-=2) {
            $utf8ar = $arabic->utf8Glyphs(substr($reportHtml, $p[$i-1], $p[$i] - $p[$i-1]));
            $reportHtml = substr_replace($reportHtml, $utf8ar, $p[$i-1], $p[$i] - $p[$i-1]);
        }

        return new FileDownload($fileName, PDF::loadHTML($reportHtml)->output());
    }
}