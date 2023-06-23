<?php

namespace Epush\File\Infra\Provider;

use Illuminate\Support\ServiceProvider;

use Epush\File\Infra\PDF\PDFDriver;
use Epush\File\Infra\PDF\PDFDriverContract;

use Epush\File\Infra\Excel\ExcelDriver;
use Epush\File\Infra\Excel\ExcelDriverContract;

class InfraProvider extends ServiceProvider
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
        $this->app->bind(PDFDriverContract::class, PDFDriver::class);
        $this->app->bind(ExcelDriverContract::class, ExcelDriver::class);
    }
}