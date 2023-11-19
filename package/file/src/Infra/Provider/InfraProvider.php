<?php

namespace Epush\File\Infra\Provider;

use Illuminate\Support\ServiceProvider;

use Epush\File\Infra\PDF\PDFDriver;
use Epush\File\Infra\PDF\PDFDriverContract;

use Epush\File\Infra\Excel\ExcelDriver;
use Epush\File\Infra\Excel\ExcelDriverContract;

use Epush\File\Infra\File\FileDriver;
use Epush\File\Infra\File\FileDriverContract;

use Epush\File\Infra\Database\Driver\File\FileDatabaseDriver;
use Epush\File\Infra\Database\Driver\File\FileDatabaseDriverContract;

use Epush\File\Infra\Database\Driver\Folder\FolderDatabaseDriver;
use Epush\File\Infra\Database\Driver\Folder\FolderDatabaseDriverContract;

use Epush\File\Infra\Database\Repository\FileRepository;
use Epush\File\Infra\Database\Repository\Contract\FileRepositoryContract;

use Epush\File\Infra\Database\Repository\FolderRepository;
use Epush\File\Infra\Database\Repository\Contract\FolderRepositoryContract;

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
        $this->app->bind(FileDriverContract::class, FileDriver::class);

        $this->app->bind(FileDatabaseDriverContract::class, FileDatabaseDriver::class);
        $this->app->bind(FolderDatabaseDriverContract::class, FolderDatabaseDriver::class);

        $this->app->bind(FileRepositoryContract::class, FileRepository::class);
        $this->app->bind(FolderRepositoryContract::class, FolderRepository::class);
    }
}