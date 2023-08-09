<?php

namespace Epush\Core;

use Epush\Core\Sales\Infra\Provider\SalesServiceProvider;
use Epush\Core\Admin\Infra\Provider\AdminServiceProvider;
use Epush\Core\Client\Infra\Provider\ClientServiceProvider;
use Epush\Core\Pricelist\Infra\Provider\PricelistServiceProvider;
use Epush\Core\BusinessField\Infra\Provider\BusinessFieldServiceProvider;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->register(SalesServiceProvider::class);
        $this->app->register(AdminServiceProvider::class);
        $this->app->register(ClientServiceProvider::class);
        $this->app->register(PricelistServiceProvider::class);
        $this->app->register(BusinessFieldServiceProvider::class);
    }
}