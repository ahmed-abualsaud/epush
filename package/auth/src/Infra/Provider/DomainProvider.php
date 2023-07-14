<?php

namespace Epush\Auth\Infra\Provider;

use Epush\Auth\Domain\DTO\UserDto;
use Epush\Auth\Domain\DTO\SigninDto;
use Epush\Auth\Domain\DTO\SignupDto;
use Epush\Auth\Domain\DTO\ResetPasswordDto;
use Epush\Auth\Domain\DTO\GeneratePasswordDto;

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
    }
}