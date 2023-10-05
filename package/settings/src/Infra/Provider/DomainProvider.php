<?php

namespace Epush\Settings\Infra\Provider;

use Epush\Settings\Domain\DTO\SettingsDto;
use Epush\Settings\Domain\DTO\AddSettingsDto;
use Epush\Settings\Domain\DTO\ListSettingsDto;
use Epush\Settings\Domain\DTO\SearchSettingsDto;
use Epush\Settings\Domain\DTO\UpdateSettingsDto;

use Illuminate\Support\ServiceProvider;

class DomainProvider extends ServiceProvider
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
        $this->app->bind(SettingsDto::class, function () {
            return new SettingsDto(['settings_id' => $this->app->make('request')->route('settings_id')]);
        });

        $this->app->bind(AddSettingsDto::class, function () {
            return new AddSettingsDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateSettingsDto::class, function () {
            return new UpdateSettingsDto($this->app->make('request')->route('settings_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListSettingsDto::class, function () {
            return new ListSettingsDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchSettingsDto::class, function () {
            return new SearchSettingsDto($this->app->make('request')->all());
        });
    }
}