<?php

namespace Epush\File\Infra\Provider;

use Epush\File\Domain\DTO\ExportDto;

use Epush\File\Domain\DTO\FileDto;
use Epush\File\Domain\DTO\AddFileDto;
use Epush\File\Domain\DTO\ListFilesDto;
use Epush\File\Domain\DTO\SearchFileDto;
use Epush\File\Domain\DTO\UpdateFileDto;

use Epush\File\Domain\DTO\FolderDto;
use Epush\File\Domain\DTO\AddFolderDto;
use Epush\File\Domain\DTO\ListFoldersDto;
use Epush\File\Domain\DTO\SearchFolderDto;
use Epush\File\Domain\DTO\UpdateFolderDto;

use Illuminate\Support\ServiceProvider;

class DomainProvider extends ServiceProvider
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
        $this->app->bind(ExportDto::class, function () {
            $data = $this->app->make('request')->all();

            if (array_key_exists('columns', $data) && gettype($data['columns']) === 'string') {
                $data['columns'] = json_decode($data['columns'], true);
            }
            if (array_key_exists('rows', $data) && gettype($data['rows']) === 'string') {
                $data['rows'] = json_decode($data['rows'], true);
            }

            return new ExportDto($data);
        });

        $this->app->bind(FileDto::class, function () {
            return new FileDto(['file_id' => $this->app->make('request')->route('file_id')]);
        });

        $this->app->bind(AddFileDto::class, function () {
            $file = $this->app->make('request')->file('file');
            $inputs = $this->app->make('request')->all();
            $inputs['file'] = $file;
            return new AddFileDto($inputs);
        });

        $this->app->bind(UpdateFileDto::class, function () {
            return new UpdateFileDto($this->app->make('request')->route('file_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListFilesDto::class, function () {
            return new ListFilesDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchFileDto::class, function () {
            return new SearchFileDto($this->app->make('request')->all());
        });



        $this->app->bind(FolderDto::class, function () {
            return new FolderDto(['folder_id' => $this->app->make('request')->route('folder_id')]);
        });

        $this->app->bind(AddFolderDto::class, function () {
            return new AddFolderDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateFolderDto::class, function () {
            return new UpdateFolderDto($this->app->make('request')->route('folder_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListFoldersDto::class, function () {
            return new ListFoldersDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchFolderDto::class, function () {
            return new SearchFolderDto($this->app->make('request')->all());
        });
    }
}