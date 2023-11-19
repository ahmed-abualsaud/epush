<?php

namespace Epush\File\Infra\Provider;

use Illuminate\Support\ServiceProvider;

use Epush\File\App\Service\FileService;
use Epush\File\App\Contract\FileServiceContract;

use Epush\File\App\Service\FileDatabaseService;
use Epush\File\App\Contract\FileDatabaseServiceContract;

use Epush\File\App\Service\FolderService;
use Epush\File\App\Contract\FolderServiceContract;

use Epush\File\App\Service\FolderDatabaseService;
use Epush\File\App\Contract\FolderDatabaseServiceContract;


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
        $this->app->bind(FileServiceContract::class, FileService::class);
        $this->app->bind(FileDatabaseServiceContract::class, FileDatabaseService::class);


        $this->app->bind(FolderServiceContract::class, FolderService::class);
        $this->app->bind(FolderDatabaseServiceContract::class, FolderDatabaseService::class);
    }
}