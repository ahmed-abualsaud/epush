<?php

namespace Epush\Core\Operator\Infra\Provider;

use Epush\Core\Operator\App\Service\OperatorService;
use Epush\Core\Operator\App\Contract\OperatorServiceContract;

use Epush\Core\Operator\App\Service\OperatorDatabaseService;
use Epush\Core\Operator\App\Contract\OperatorDatabaseServiceContract;

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
        $this->app->bind(OperatorServiceContract::class, OperatorService::class);
        $this->app->bind(OperatorDatabaseServiceContract::class, OperatorDatabaseService::class);
    }
}