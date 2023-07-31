<?php

namespace Epush\Mail\Infra\Provider;

use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../Present/View', 'mail');
    }


    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/mail.php', 'mail');

        $this->app->register(AppProvider::class);
        $this->app->register(InfraProvider::class);
    }
}