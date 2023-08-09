<?php

namespace Epush\Auth\Infra\Provider;

use Epush\Auth\Domain\DTO\UserDto;
use Epush\Auth\Domain\DTO\RoleDto;
use Epush\Auth\Domain\DTO\SigninDto;
use Epush\Auth\Domain\DTO\SignupDto;
use Epush\Auth\Domain\DTO\AddRoleDto;
use Epush\Auth\Domain\DTO\ListUsersDto;
use Epush\Auth\Domain\DTO\ListRolesDto;
use Epush\Auth\Domain\DTO\PermissionDto;
use Epush\Auth\Domain\DTO\UpdateUserDto;
use Epush\Auth\Domain\DTO\UpdateRoleDto;
use Epush\Auth\Domain\DTO\SearchUserDto;
use Epush\Auth\Domain\DTO\ResetPasswordDto;
use Epush\Auth\Domain\DTO\ListPermissionsDto;
use Epush\Auth\Domain\DTO\AssignUserRolesDto;
use Epush\Auth\Domain\DTO\GeneratePasswordDto;
use Epush\Auth\Domain\DTO\UpdatePermissionDto;
use Epush\Auth\Domain\DTO\UnassignUserRolesDto;
use Epush\Auth\Domain\DTO\AssignUserPermissionsDto;
use Epush\Auth\Domain\DTO\AssignRolePermissionsDto;
use Epush\Auth\Domain\DTO\UnassignRolePermissionsDto;
use Epush\Auth\Domain\DTO\UnassignUserPermissionsDto;

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
        $this->app->bind(UserDto::class, function () {
            return new UserDto(['user_id' => $this->app->make('request')->route('user_id')]);
        });

        $this->app->bind(RoleDto::class, function () {
            return new RoleDto(['role_id' => $this->app->make('request')->route('role_id')]);
        });

        $this->app->bind(PermissionDto::class, function () {
            return new PermissionDto(['permission_id' => $this->app->make('request')->route('permission_id')]);
        });

        $this->app->bind(SigninDto::class, function () {
            return new SigninDto($this->app->make('request')->all());
        });

        $this->app->bind(SignupDto::class, function () {
            return new SignupDto($this->app->make('request')->all());
        });

        $this->app->bind(ResetPasswordDto::class, function () {
            return new ResetPasswordDto($this->app->make('request')->all());
        });

        $this->app->bind(GeneratePasswordDto::class, function () {
            return new GeneratePasswordDto($this->app->make('request')->all());
        });

        $this->app->bind(ListUsersDto::class, function () {
            return new ListUsersDto($this->app->make('request')->all());
        });

        $this->app->bind(ListRolesDto::class, function () {
            return new ListRolesDto($this->app->make('request')->all());
        });

        $this->app->bind(ListPermissionsDto::class, function () {
            return new ListPermissionsDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateUserDto::class, function () {
            return new UpdateUserDto($this->app->make('request')->route('user_id'), $this->app->make('request')->all());
        });

        $this->app->bind(AssignUserRolesDto::class, function () {
            return new AssignUserRolesDto($this->app->make('request')->all());
        });

        $this->app->bind(UnassignUserRolesDto::class, function () {
            return new UnassignUserRolesDto($this->app->make('request')->all());
        });

        $this->app->bind(AssignUserPermissionsDto::class, function () {
            return new AssignUserPermissionsDto($this->app->make('request')->all());
        });

        $this->app->bind(UnassignUserPermissionsDto::class, function () {
            return new UnassignUserPermissionsDto($this->app->make('request')->all());
        });

        $this->app->bind(AddRoleDto::class, function () {
            return new AddRoleDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateRoleDto::class, function () {
            return new UpdateRoleDto($this->app->make('request')->route('role_id'), $this->app->make('request')->all());
        });

        $this->app->bind(UpdatePermissionDto::class, function () {
            return new UpdatePermissionDto($this->app->make('request')->route('permission_id'), $this->app->make('request')->all());
        });

        $this->app->bind(AssignRolePermissionsDto::class, function () {
            return new AssignRolePermissionsDto($this->app->make('request')->all());
        });

        $this->app->bind(UnassignRolePermissionsDto::class, function () {
            return new UnassignRolePermissionsDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchUserDto::class, function () {
            return new SearchUserDto($this->app->make('request')->all());
        });
    }
}