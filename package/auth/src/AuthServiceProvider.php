<?php

namespace Epush\Auth;

use Epush\Auth\User\Infra\Provider\UserServiceProvider;
use Epush\Auth\Role\Infra\Provider\RoleServiceProvider;
use Epush\Auth\Permission\Infra\Provider\PermissionServiceProvider;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->register(UserServiceProvider::class);
        $this->app->register(RoleServiceProvider::class);
        $this->app->register(PermissionServiceProvider::class);
    }
}