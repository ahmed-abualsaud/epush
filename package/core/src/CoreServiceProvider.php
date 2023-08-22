<?php

namespace Epush\Core;

use Epush\Core\SMSC\Infra\Provider\SMSCServiceProvider;
use Epush\Core\Sales\Infra\Provider\SalesServiceProvider;
use Epush\Core\Admin\Infra\Provider\AdminServiceProvider;
use Epush\Core\Client\Infra\Provider\ClientServiceProvider;
use Epush\Core\Sender\Infra\Provider\SenderServiceProvider;
use Epush\Core\Country\Infra\Provider\CountryServiceProvider;
use Epush\Core\Operator\Infra\Provider\OperatorServiceProvider;
use Epush\Core\Pricelist\Infra\Provider\PricelistServiceProvider;
use Epush\Core\SMSCBinding\Infra\Provider\SMSCBindingServiceProvider;
use Epush\Core\BusinessField\Infra\Provider\BusinessFieldServiceProvider;
use Epush\Core\SenderConnection\Infra\Provider\SenderConnectionServiceProvider;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->register(SMSCServiceProvider::class);
        $this->app->register(SalesServiceProvider::class);
        $this->app->register(AdminServiceProvider::class);
        $this->app->register(ClientServiceProvider::class);
        $this->app->register(SenderServiceProvider::class);
        $this->app->register(CountryServiceProvider::class);
        $this->app->register(OperatorServiceProvider::class);
        $this->app->register(PricelistServiceProvider::class);
        $this->app->register(SMSCBindingServiceProvider::class);
        $this->app->register(BusinessFieldServiceProvider::class);
        $this->app->register(SenderConnectionServiceProvider::class);
    }
}