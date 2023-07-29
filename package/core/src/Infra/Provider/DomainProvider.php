<?php

namespace Epush\Core\Infra\Provider;

use Epush\Core\Domain\DTO\ClientDto;

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
        $this->app->bind(ClientDto::class, function () {
            return new ClientDto(['client_id' => $this->app->make('request')->route('client_id')]);
        });
    }
}