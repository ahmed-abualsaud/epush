<?php

namespace Epush\Core\SMSCBinding\Infra\Provider;

use Epush\Core\SMSCBinding\Domain\DTO\SMSCBindingDto;
use Epush\Core\SMSCBinding\Domain\DTO\AddSMSCBindingDto;
use Epush\Core\SMSCBinding\Domain\DTO\ListSMSCBindingsDto;
use Epush\Core\SMSCBinding\Domain\DTO\SearchSMSCBindingDto;
use Epush\Core\SMSCBinding\Domain\DTO\UpdateSMSCBindingDto;

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
        $this->app->bind(SMSCBindingDto::class, function () {
            return new SMSCBindingDto(['smsc_binding_id' => $this->app->make('request')->route('smsc_binding_id')]);
        });

        $this->app->bind(AddSMSCBindingDto::class, function () {
            return new AddSMSCBindingDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateSMSCBindingDto::class, function () {
            return new UpdateSMSCBindingDto($this->app->make('request')->route('smsc_binding_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListSMSCBindingsDto::class, function () {
            return new ListSMSCBindingsDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchSMSCBindingDto::class, function () {
            return new SearchSMSCBindingDto($this->app->make('request')->all());
        });
    }
}