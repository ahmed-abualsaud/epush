<?php

namespace Epush\Settings\Infra\Provider;

use Epush\Settings\App\Service\SettingsService;
use Epush\Settings\App\Contract\SettingsServiceContract;

use Epush\Settings\App\Service\SettingsDatabaseService;
use Epush\Settings\App\Contract\SettingsDatabaseServiceContract;

use Illuminate\Support\ServiceProvider;

class AppProvider extends ServiceProvider
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
        $this->app->bind(SettingsServiceContract::class, SettingsService::class);
        $this->app->bind(SettingsDatabaseServiceContract::class, SettingsDatabaseService::class);
    }
}