<?php

namespace Epush\Core\BusinessField\Infra\Provider;

use Epush\Core\BusinessField\Domain\DTO\BusinessFieldDto;
use Epush\Core\BusinessField\Domain\DTO\AddBusinessFieldDto;
use Epush\Core\BusinessField\Domain\DTO\UpdateBusinessFieldDto;

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
        $this->app->bind(BusinessFieldDto::class, function () {
            return new BusinessFieldDto(['business_field_id' => $this->app->make('request')->route('business_field_id')]);
        });

        $this->app->bind(AddBusinessFieldDto::class, function () {
            return new AddBusinessFieldDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateBusinessFieldDto::class, function () {
            return new UpdateBusinessFieldDto($this->app->make('request')->route('business_field_id'), $this->app->make('request')->all());
        });
    }
}