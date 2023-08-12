<?php

namespace Epush\Auth\User\Infra\Provider;

use Epush\Auth\User\Domain\DTO\UserDto;
use Epush\Auth\User\Domain\DTO\SigninDto;
use Epush\Auth\User\Domain\DTO\SignupDto;
use Epush\Auth\User\Domain\DTO\ListUsersDto;
use Epush\Auth\User\Domain\DTO\UpdateUserDto;
use Epush\Auth\User\Domain\DTO\SearchUserDto;
use Epush\Auth\User\Domain\DTO\ResetPasswordDto;
use Epush\Auth\User\Domain\DTO\AssignUserRolesDto;
use Epush\Auth\User\Domain\DTO\GeneratePasswordDto;
use Epush\Auth\User\Domain\DTO\UnassignUserRolesDto;
use Epush\Auth\User\Domain\DTO\AssignUserPermissionsDto;
use Epush\Auth\User\Domain\DTO\UnassignUserPermissionsDto;

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

        $this->app->bind(SearchUserDto::class, function () {
            return new SearchUserDto($this->app->make('request')->all());
        });
    }
}