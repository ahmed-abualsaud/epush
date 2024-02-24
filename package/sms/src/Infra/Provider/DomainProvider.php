<?php

namespace Epush\SMS\Infra\Provider;

use Epush\SMS\Domain\DTO\SMSTemplateDto;
use Epush\SMS\Domain\DTO\AddSMSTemplateDto;
use Epush\SMS\Domain\DTO\UpdateSMSTemplateDto;

use Epush\SMS\Domain\DTO\ListSMSTemplatesDto;
use Epush\SMS\Domain\DTO\SMSSendingHandlerDto;
use Epush\SMS\Domain\DTO\AddSMSSendingHandlerDto;
use Epush\SMS\Domain\DTO\ListSMSSendingHandlersDto;
use Epush\SMS\Domain\DTO\SearchSMSSendingHandlerDto;
use Epush\SMS\Domain\DTO\UpdateSMSSendingHandlerDto;

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
        $this->app->bind(SMSTemplateDto::class, function () {
            return new SMSTemplateDto(['sms_template_id' => $this->app->make('request')->route('sms_template_id')]);
        });

        $this->app->bind(AddSMSTemplateDto::class, function () {
            return new AddSMSTemplateDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateSMSTemplateDto::class, function () {
            return new UpdateSMSTemplateDto($this->app->make('request')->route('sms_template_id'), $this->app->make('request')->all());
        });

        $this->app->bind(SMSSendingHandlerDto::class, function () {
            return new SMSSendingHandlerDto(['sms_sending_handler_id' => $this->app->make('request')->route('sms_sending_handler_id')]);
        });

        $this->app->bind(ListSMSSendingHandlersDto::class, function () {
            return new ListSMSSendingHandlersDto($this->app->make('request')->all());
        });

        $this->app->bind(ListSMSTemplatesDto::class, function () {
            return new ListSMSTemplatesDto($this->app->make('request')->all());
        });

        $this->app->bind(AddSMSSendingHandlerDto::class, function () {
            return new AddSMSSendingHandlerDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateSMSSendingHandlerDto::class, function () {
            return new UpdateSMSSendingHandlerDto($this->app->make('request')->route('sms_sending_handler_id'), $this->app->make('request')->all());
        });

        $this->app->bind(SearchSMSSendingHandlerDto::class, function () {
            return new SearchSMSSendingHandlerDto($this->app->make('request')->all());
        });
    }
}