<?php

namespace Epush\Core\MessageLanguage\Infra\Provider;

use Epush\Core\MessageLanguage\Infra\Database\Driver\MessageLanguageDatabaseDriver;
use Epush\Core\MessageLanguage\Infra\Database\Driver\MessageLanguageDatabaseDriverContract;

use Epush\Core\MessageLanguage\Infra\Database\Repository\MessageLanguageRepository;
use Epush\Core\MessageLanguage\Infra\Database\Repository\Contract\MessageLanguageRepositoryContract;

use Illuminate\Support\ServiceProvider;

class InfraProvider extends ServiceProvider
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
        $this->app->bind(MessageLanguageRepositoryContract::class, MessageLanguageRepository::class);

        $this->app->bind(MessageLanguageDatabaseDriverContract::class, MessageLanguageDatabaseDriver::class);
    }
}