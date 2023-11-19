<?php

namespace Epush\File\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\File\Infra\Database\Model\Folder;
use Epush\File\Infra\Database\Repository\Contract\FolderRepositoryContract;

class FolderRepository implements FolderRepositoryContract
{
    public function __construct(

        private Folder $folder
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->folder->paginate($take)->toArray();

        });
    }

    public function get(string $folderID): array
    {
        return DB::transaction(function () use ($folderID) {

            $folder =  $this->folder->where('id', $folderID)->first();
            return empty($folder) ? [] : $folder->toArray();
        });
    }
    
    public function create(array $folder): array
    {
        return DB::transaction(function () use ($folder) {

            return $this->folder->create($folder)->toArray();
        });
    }

    public function delete(string $folderID): bool
    {
        return DB::transaction(function () use ($folderID) {

            return $this->folder->where('id', $folderID)->delete();

        }); 
    }

    public function update(string $folderID, array $data): array
    {
        return DB::transaction(function () use ($folderID, $data) {

            $folder = $this->folder->where('id', $folderID)->firstOrFail();

            if (! empty($data)) {
                $folder->update($data);
            }

            return $folder->toArray();

        }); 
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            return $this->folder
                ->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
                ->paginate($take)->toArray();
        });
    }
}