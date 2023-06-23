<?php

namespace Epush\File\Infra\Provider;

use Illuminate\Support\ServiceProvider;

use Epush\File\App\Services\PDF\PDFService;
use Epush\File\App\Contracts\PDF\PDFServiceContract;

use Epush\File\App\Services\Excel\ExcelService;
use Epush\File\App\Contracts\Excel\ExcelServiceContract;

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
    }
}