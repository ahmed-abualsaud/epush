<?php

namespace Epush\File\Infra\Provider;

use Illuminate\Support\ServiceProvider;

use Epush\File\App\Service\PDF\PDFService;
use Epush\File\App\Contract\PDF\PDFServiceContract;

use Epush\File\App\Service\Excel\ExcelService;
use Epush\File\App\Contract\Excel\ExcelServiceContract;

use Epush\File\App\Service\File\FileService;
use Epush\File\App\Contract\File\FileServiceContract;

class AppProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PDFServiceContract::class, PDFService::class);
        $this->app->bind(ExcelServiceContract::class, ExcelService::class);
        $this->app->bind(FileServiceContract::class, FileService::class);
    }
}