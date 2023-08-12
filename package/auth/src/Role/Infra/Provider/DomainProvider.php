<?php

namespace Epush\Auth\Role\Infra\Provider;

use Epush\Auth\Role\Domain\DTO\RoleDto;
use Epush\Auth\Role\Domain\DTO\AddRoleDto;
use Epush\Auth\Role\Domain\DTO\ListRolesDto;
use Epush\Auth\Role\Domain\DTO\UpdateRoleDto;
use Epush\Auth\Role\Domain\DTO\AssignRolePermissionsDto;
use Epush\Auth\Role\Domain\DTO\UnassignRolePermissionsDto;

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
        $this->app->bind(RoleDto::class, function () {
            return new RoleDto(['role_id' => $this->app->make('request')->route('role_id')]);
        });

        $this->app->bind(ListRolesDto::class, function () {
            return new ListRolesDto($this->app->make('request')->all());
        });

        $this->app->bind(AddRoleDto::class, function () {
            return new AddRoleDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateRoleDto::class, function () {
            return new UpdateRoleDto($this->app->make('request')->route('role_id'), $this->app->make('request')->all());
        });

        $this->app->bind(AssignRolePermissionsDto::class, function () {
            return new AssignRolePermissionsDto($this->app->make('request')->all());
        });

        $this->app->bind(UnassignRolePermissionsDto::class, function () {
            return new UnassignRolePermissionsDto($this->app->make('request')->all());
        });
    }
}