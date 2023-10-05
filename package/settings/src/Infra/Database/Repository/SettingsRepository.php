<?php

namespace Epush\Settings\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Settings\Infra\Database\Model\Settings;
use Epush\Settings\Infra\Database\Repository\Contract\SettingsRepositoryContract;

class SettingsRepository implements SettingsRepositoryContract
{
    public function __construct(

        private Settings $settings
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->settings->paginate($take)->toArray();

        });
    }

    public function get(string $settingsID): array
    {
        return DB::transaction(function () use ($settingsID) {

            $settings =  $this->settings->where('id', $settingsID)->first();
            return empty($settings) ? [] : $settings->toArray();
        });
    }

    public function getByName(string $settingsName): array
    {
        return DB::transaction(function () use ($settingsName) {

            $settings =  $this->settings->where('name', $settingsName)->first();
            return empty($settings) ? [] : $settings->toArray();
        });
    }
    
    public function create(array $settings): array
    {
        return DB::transaction(function () use ($settings) {

            return $this->settings->create($settings)->toArray();
        });
    }

    public function delete(string $settingsID): bool
    {
        return DB::transaction(function () use ($settingsID) {

            return $this->settings->where('id', $settingsID)->delete();

        }); 
    }

    public function update(string $settingsID, array $data): array
    {
        return DB::transaction(function () use ($settingsID, $data) {

            $settings = $this->settings->where('id', $settingsID)->firstOrFail();

            if (! empty($data)) {
                $settings->update($data);
            }

            return $settings->toArray();

        }); 
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            return $this->settings
                ->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
                ->paginate($take)->toArray();
        });
    }
}