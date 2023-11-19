<?php

namespace Epush\File\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\File\Infra\Database\Model\File;
use Epush\File\Infra\Database\Repository\Contract\FileRepositoryContract;

class FileRepository implements FileRepositoryContract
{
    public function __construct(

        private File $file
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->file->paginate($take)->toArray();

        });
    }

    public function get(string $fileID): array
    {
        return DB::transaction(function () use ($fileID) {

            $file =  $this->file->where('id', $fileID)->first();
            return empty($file) ? [] : $file->toArray();
        });
    }
    
    public function create(array $file): array
    {
        return DB::transaction(function () use ($file) {

            return $this->file->create($file)->toArray();
        });
    }

    public function delete(string $fileID): bool
    {
        return DB::transaction(function () use ($fileID) {

            return $this->file->where('id', $fileID)->delete();

        }); 
    }

    public function update(string $fileID, array $data): array
    {
        return DB::transaction(function () use ($fileID, $data) {

            $file = $this->file->where('id', $fileID)->firstOrFail();

            if (! empty($data)) {
                $file->update($data);
            }

            return $file->toArray();

        }); 
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            return $this->file
                ->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
                ->paginate($take)->toArray();
        });
    }


    public function getFolderFiles(string $folderID): array
    {
        return DB::transaction(function () use ($folderID) {

            return $this->file->where('folder_id', $folderID)->get()->toArray();
        });
    }

    public function deleteFolderFiles(string $folderID): bool
    {
        return DB::transaction(function () use ($folderID) {

            return $this->file->where('folder_id', $folderID)->delete();
        });
    }
}