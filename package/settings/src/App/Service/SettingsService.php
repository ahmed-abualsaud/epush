<?php

namespace Epush\Settings\App\Service;


use Epush\Settings\App\Contract\SettingsServiceContract;
use Epush\Settings\App\Contract\SettingsDatabaseServiceContract;

class SettingsService implements SettingsServiceContract
{
    public function __construct(

        private SettingsDatabaseServiceContract $settingsDatabaseService

    ) {}


    public function list(int $take): array
    {
        return $this->settingsDatabaseService->paginateSettings($take);
    }

    public function get(string $settingsID): array
    {
        return $this->settingsDatabaseService->getSettings($settingsID);
    }

    public function getByName(string $settingsName): array
    {
        return $this->settingsDatabaseService->getSettingsByName($settingsName);
    }

    public function add(array $settings): array
    {
        return $this->settingsDatabaseService->addSettings($settings);
    }

    public function update(string $settingsID, array $settings): array
    {
        return $this->settingsDatabaseService->updateSettings($settingsID, $settings);
    }

    public function delete(string $settingsID): bool
    {
        return $this->settingsDatabaseService->deleteSettings($settingsID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return $this->settingsDatabaseService->searchSettingsColumn($column, $value, $take);
    }
}