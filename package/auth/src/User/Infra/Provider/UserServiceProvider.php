<?php

namespace Epush\Auth\User\Infra\Provider;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\CachesConfiguration;

use Epush\Auth\User\Present\Http\Middleware\AuthMiddleware;
use Epush\Auth\User\Present\Http\Middleware\RefreshTokenMiddleware;

class UserServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app(Kernel::class)->pushMiddleware(RefreshTokenMiddleware::class);
        app(Kernel::class)->pushMiddleware(AuthMiddleware::class);
        app(Kernel::class)->prependToMiddlewarePriority(AuthMiddleware::class);
        app(Kernel::class)->prependToMiddlewarePriority(RefreshTokenMiddleware::class);
    }

    public function register()
    {
        if (! ($this->app instanceof CachesConfiguration && $this->app->configurationIsCached())) {
            
            $config = $this->app->make('config');
            $config->set(
                'route-attributes.directories.Epush\\Auth\\User\\Present\\Http\\Controller\\', 
                base_path('package/auth/src/User/Present/Http/Controller')
            );

            $config->set(
                'auth', 
                require __DIR__.'/../Config/auth.php'
            );

            $config->set(
                'recaptcha', 
                require __DIR__.'/../Config/recaptcha.php'
            );
        }

        $this->app->register(DomainProvider::class);
        $this->app->register(AppProvider::class);
        $this->app->register(InfraProvider::class);
    }
}