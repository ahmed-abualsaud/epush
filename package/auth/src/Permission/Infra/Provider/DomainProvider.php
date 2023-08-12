<?php

namespace Epush\Auth\Permission\Infra\Provider;

use Epush\Auth\Permission\Domain\DTO\PermissionDto;
use Epush\Auth\Permission\Domain\DTO\ListPermissionsDto;
use Epush\Auth\Permission\Domain\DTO\UpdatePermissionDto;

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
        $this->app->bind(PermissionDto::class, function () {
            return new PermissionDto(['permission_id' => $this->app->make('request')->route('permission_id')]);
        });

        $this->app->bind(ListPermissionsDto::class, function () {
            return new ListPermissionsDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdatePermissionDto::class, function () {
            return new UpdatePermissionDto($this->app->make('request')->route('permission_id'), $this->app->make('request')->all());
        });
    }
}