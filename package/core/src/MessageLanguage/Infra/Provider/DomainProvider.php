<?php

namespace Epush\Core\MessageLanguage\Infra\Provider;

use Epush\Core\MessageLanguage\Domain\DTO\MessageLanguageDto;
use Epush\Core\MessageLanguage\Domain\DTO\AddMessageLanguageDto;
use Epush\Core\MessageLanguage\Domain\DTO\ListMessageLanguagesDto;
use Epush\Core\MessageLanguage\Domain\DTO\SearchMessageLanguageDto;
use Epush\Core\MessageLanguage\Domain\DTO\UpdateMessageLanguageDto;

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
        $this->app->bind(MessageLanguageDto::class, function () {
            return new MessageLanguageDto(['message_language_id' => $this->app->make('request')->route('message_language_id')]);
        });

        $this->app->bind(AddMessageLanguageDto::class, function () {
            return new AddMessageLanguageDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateMessageLanguageDto::class, function () {
            return new UpdateMessageLanguageDto($this->app->make('request')->route('message_language_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListMessageLanguagesDto::class, function () {
            return new ListMessageLanguagesDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchMessageLanguageDto::class, function () {
            return new SearchMessageLanguageDto($this->app->make('request')->all());
        });
    }
}