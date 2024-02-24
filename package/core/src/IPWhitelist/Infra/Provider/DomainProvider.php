<?php

namespace Epush\Core\IPWhitelist\Infra\Provider;

use Epush\Core\IPWhitelist\Domain\DTO\IPWhitelistDto;
use Epush\Core\IPWhitelist\Domain\DTO\AddIPWhitelistDto;
use Epush\Core\IPWhitelist\Domain\DTO\ListIPWhitelistsDto;
use Epush\Core\IPWhitelist\Domain\DTO\UpdateIPWhitelistDto;

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
        $this->app->bind(IPWhitelistDto::class, function () {
            return new IPWhitelistDto(['ipwhitelist_id' => $this->app->make('request')->route('ipwhitelist_id')]);
        });

        $this->app->bind(AddIPWhitelistDto::class, function () {
            return new AddIPWhitelistDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateIPWhitelistDto::class, function () {
            return new UpdateIPWhitelistDto($this->app->make('request')->route('ipwhitelist_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListIPWhitelistsDto::class, function () {
            return new ListIPWhitelistsDto($this->app->make('request')->all());
        });
    }
}