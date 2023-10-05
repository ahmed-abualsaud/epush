<?php

namespace Epush\Settings\Infra\Database\Driver;

use Epush\Settings\Infra\Database\Repository\Contract\SettingsRepositoryContract;

interface SettingsDatabaseDriverContract
{
    public function settingsRepository(): SettingsRepositoryContract;
}