<?php

namespace Epush\Core\Partner\Infra\Provider;

use Epush\Core\Partner\Domain\DTO\PartnerDto;
use Epush\Core\Partner\Domain\DTO\AddPartnerDto;
use Epush\Core\Partner\Domain\DTO\ListPartnersDto;
use Epush\Core\Partner\Domain\DTO\SearchPartnerDto;
use Epush\Core\Partner\Domain\DTO\UpdatePartnerDto;

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
        $this->app->bind(PartnerDto::class, function () {
            return new PartnerDto(['user_id' => $this->app->make('request')->route('user_id')]);
        });

        $this->app->bind(AddPartnerDto::class, function () {
            return new AddPartnerDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdatePartnerDto::class, function () {
            return new UpdatePartnerDto($this->app->make('request')->route('user_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListPartnersDto::class, function () {
            return new ListPartnersDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchPartnerDto::class, function () {
            return new SearchPartnerDto($this->app->make('request')->all());
        });
    }
}