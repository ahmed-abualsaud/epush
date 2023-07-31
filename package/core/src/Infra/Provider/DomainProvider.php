<?php

namespace Epush\Core\Infra\Provider;

use Epush\Core\Domain\DTO\ClientDto;
use Epush\Core\Domain\DTO\AddClientDto;

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
            return new ClientDto(['user_id' => $this->app->make('request')->route('user_id')]);
        });

        $this->app->bind(AddClientDto::class, function () {
            return new AddClientDto($this->app->make('request')->all());
        });
    }
}