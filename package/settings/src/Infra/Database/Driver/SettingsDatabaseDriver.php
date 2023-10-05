<?php

namespace Epush\Settings\Infra\Database\Driver;

use Epush\Settings\Infra\Database\Repository\Contract\SettingsRepositoryContract;

class SettingsDatabaseDriver implements SettingsDatabaseDriverContract
{
    public function __construct(

        private SettingsRepositoryContract $settingsRepository

    ) {}

    public function settingsRepository(): SettingsRepositoryContract
    {
        return $this->settingsRepository;
    }
}