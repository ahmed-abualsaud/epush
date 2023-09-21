<?php

namespace Epush\Mail\Infra\Provider;

use Epush\Mail\Domain\DTO\MailTemplateDto;
use Epush\Mail\Domain\DTO\AddMailTemplateDto;
use Epush\Mail\Domain\DTO\UpdateMailTemplateDto;

use Epush\Mail\Domain\DTO\MailSendingHandlerDto;
use Epush\Mail\Domain\DTO\AddMailSendingHandlerDto;
use Epush\Mail\Domain\DTO\UpdateMailSendingHandlerDto;

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
        $this->app->bind(MailTemplateDto::class, function () {
            return new MailTemplateDto(['mail_template_id' => $this->app->make('request')->route('mail_template_id')]);
        });

        $this->app->bind(AddMailTemplateDto::class, function () {
            return new AddMailTemplateDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateMailTemplateDto::class, function () {
            return new UpdateMailTemplateDto($this->app->make('request')->route('mail_template_id'), $this->app->make('request')->all());
        });

        $this->app->bind(MailSendingHandlerDto::class, function () {
            return new MailSendingHandlerDto(['mail_sending_handler_id' => $this->app->make('request')->route('mail_sending_handler_id')]);
        });

        $this->app->bind(AddMailSendingHandlerDto::class, function () {
            return new AddMailSendingHandlerDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateMailSendingHandlerDto::class, function () {
            return new UpdateMailSendingHandlerDto($this->app->make('request')->route('mail_sending_handler_id'), $this->app->make('request')->all());
        });
    }
}