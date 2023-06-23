<?php

namespace Epush\File\Infra\Provider;

use Epush\File\Domain\DTOs\DataDto;
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
        $this->app->bind(DataDto::class, function () {
            return new DataDto($this->app->make('request')->all());
        });
    }
}