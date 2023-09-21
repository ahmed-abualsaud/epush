<?php

namespace Epush\Core\MessageLanguage\Infra\Provider;

use Epush\Core\MessageLanguage\App\Service\MessageLanguageService;
use Epush\Core\MessageLanguage\App\Contract\MessageLanguageServiceContract;

use Epush\Core\MessageLanguage\App\Service\MessageLanguageDatabaseService;
use Epush\Core\MessageLanguage\App\Contract\MessageLanguageDatabaseServiceContract;

use Illuminate\Support\ServiceProvider;

class AppProvider extends ServiceProvider
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
        $this->app->bind(MessageLanguageServiceContract::class, MessageLanguageService::class);
        $this->app->bind(MessageLanguageDatabaseServiceContract::class, MessageLanguageDatabaseService::class);
    }
}