<?php

namespace Epush\Core\Banner\Infra\Provider;

use Epush\Core\Banner\Domain\DTO\BannerDto;
use Epush\Core\Banner\Domain\DTO\AddBannerDto;
use Epush\Core\Banner\Domain\DTO\UpdateBannerDto;

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
        $this->app->bind(BannerDto::class, function () {
            return new BannerDto(['banner_id' => $this->app->make('request')->route('banner_id')]);
        });

        $this->app->bind(AddBannerDto::class, function () {
            return new AddBannerDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateBannerDto::class, function () {
            return new UpdateBannerDto($this->app->make('request')->route('banner_id'), $this->app->make('request')->all());
        });
    }
}