<?php

namespace Epush\Core\Banner\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\Banner\Infra\Database\Model\Banner;
use Epush\Core\Banner\Infra\Database\Repository\Contract\BannerRepositoryContract;

class BannerRepository implements BannerRepositoryContract
{
    public function __construct(

        private Banner $banner,
        
    ) {}

    public function all(): array
    {
        return DB::transaction(function () {

            return $this->banner->all()->toArray();

        });
    }

    public function get(string $id): array
    {
        return DB::transaction(function () use ($id) {

            return $this->banner->findOrFail($id)->toArray();
        });
    }

    public function create(array $client): array
    {
        return DB::transaction(function () use ($client) {

            return $this->banner->create($client)->toArray();
        });
    }

    public function update(string $id, array $data): array
    {
        return DB::transaction(function () use ($id, $data) {

            $client = $this->banner->findOrFail($id);

            if (! empty($data)) {
                $client->update($data);
            }

            return $client->toArray();

        }); 
    }

    public function delete(string $id): bool
    {
        return DB::transaction(function () use ($id) {

            return $this->banner->where('id', $id)->delete();

        }); 
    }

    public function getBanners(array $bannersID): array
    {
        return DB::transaction(function () use ($bannersID) {

            return $this->banner->whereIn('id', $bannersID)->get()->toArray();

        }); 
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            $banner = $this->banner->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'");
            $banner = $take >= 1000000000000 ? $banner->paginate($take, ['*'], 'page', 1) : $banner->paginate($take);
            return $banner->toArray();

        });
    }
}