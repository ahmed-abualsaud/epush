<?php

namespace Epush\Settings\App\Service;

use Epush\Settings\App\Contract\SettingsDatabaseServiceContract;
use Epush\Settings\Infra\Database\Driver\SettingsDatabaseDriverContract;

class SettingsDatabaseService implements SettingsDatabaseServiceContract
{
    public function __construct(

        private SettingsDatabaseDriverContract $settingsDatabaseDriver

    ) {}

    public function getSettings(string $settingsID): array
    {
        return $this->settingsDatabaseDriver->settingsRepository()->get($settingsID);
    }

    public function getSettingsByName(string $settingsName): array
    {
        return $this->settingsDatabaseDriver->settingsRepository()->getByName($settingsName);
    }

    public function paginateSettings(int $take): array
    {
        return $this->settingsDatabaseDriver->settingsRepository()->all($take);
    }

    public function addSettings(array $settings): array
    {
        return $this->settingsDatabaseDriver->settingsRepository()->create($settings);
    }

    public function updateSettings(string $settingsID, array $settings): array
    {
        return $this->settingsDatabaseDriver->settingsRepository()->update($settingsID, $settings);
    }

    public function deleteSettings(string $settingsID): bool
    {
        return $this->settingsDatabaseDriver->settingsRepository()->delete($settingsID);
    }

    public function searchSettingsColumn(string $column, string $value, int $take = 10): array
    {
        return $this->settingsDatabaseDriver->settingsRepository()->searchColumn($column, $value, $take);
    }
}