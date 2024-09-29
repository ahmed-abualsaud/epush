<?php

namespace Epush\Core\Client\Infra\Provider;

use Epush\Core\Client\Domain\DTO\ClientDto;
use Epush\Core\Client\Domain\DTO\AddClientDto;
use Epush\Core\Client\Domain\DTO\ListClientsDto;
use Epush\Core\Client\Domain\DTO\SearchClientDto;
use Epush\Core\Client\Domain\DTO\UpdateClientDto;

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
            return new ClientDto([
                'user_id' => $this->app->make('request')->route('user_id'),
                'take' => $this->app->make('request')->input('take') ?? null
            ]);
        });

        $this->app->bind(AddClientDto::class, function () {
            return new AddClientDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateClientDto::class, function () {
            return new UpdateClientDto($this->app->make('request')->route('user_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListClientsDto::class, function () {
            return new ListClientsDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchClientDto::class, function () {
            return new SearchClientDto($this->app->make('request')->all());
        });
    }
}