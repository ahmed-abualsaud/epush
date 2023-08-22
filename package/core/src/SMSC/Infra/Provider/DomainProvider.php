<?php

namespace Epush\Core\SMSC\Infra\Provider;

use Epush\Core\SMSC\Domain\DTO\SMSCDto;
use Epush\Core\SMSC\Domain\DTO\AddSMSCDto;
use Epush\Core\SMSC\Domain\DTO\ListSMSCsDto;
use Epush\Core\SMSC\Domain\DTO\SearchSMSCDto;
use Epush\Core\SMSC\Domain\DTO\UpdateSMSCDto;

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
        $this->app->bind(SMSCDto::class, function () {
            return new SMSCDto(['smsc_id' => $this->app->make('request')->route('smsc_id')]);
        });

        $this->app->bind(AddSMSCDto::class, function () {
            return new AddSMSCDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateSMSCDto::class, function () {
            return new UpdateSMSCDto($this->app->make('request')->route('smsc_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListSMSCsDto::class, function () {
            return new ListSMSCsDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchSMSCDto::class, function () {
            return new SearchSMSCDto($this->app->make('request')->all());
        });
    }
}