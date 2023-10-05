<?php

namespace Epush\Settings\Infra\Provider;

use Epush\Settings\Infra\Database\Driver\SettingsDatabaseDriver;
use Epush\Settings\Infra\Database\Driver\SettingsDatabaseDriverContract;

use Epush\Settings\Infra\Database\Repository\SettingsRepository;
use Epush\Settings\Infra\Database\Repository\Contract\SettingsRepositoryContract;

use Illuminate\Support\ServiceProvider;

class InfraProvider extends ServiceProvider
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
        $this->app->bind(SettingsRepositoryContract::class, SettingsRepository::class);

        $this->app->bind(SettingsDatabaseDriverContract::class, SettingsDatabaseDriver::class);
    }
}