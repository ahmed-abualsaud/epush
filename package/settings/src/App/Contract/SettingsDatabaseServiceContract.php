<?php

namespace Epush\Settings\App\Contract;

interface SettingsDatabaseServiceContract
{
    public function getSettings(string $settingsID): array;

    public function getSettingsByName(string $settingsName): array;

    public function addSettings(array $settings): array;

    public function deleteSettings(string $settingsID): bool;

    public function updateSettings(string $settingsID, array $settings): array;

    public function paginateSettings(int $take): array;

    public function searchSettingsColumn(string $column, string $value, int $take = 10): array;
}