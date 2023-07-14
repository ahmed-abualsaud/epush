<?php

namespace Epush\Orchi\Infra\Provider;

use Epush\Orchi\Domain\DTO\AppServiceDto;
use Epush\Orchi\Domain\DTO\ContextDto;
use Epush\Orchi\Domain\DTO\HandleGroupDto;
use Epush\Orchi\Domain\DTO\HandlerDto;

use Epush\Orchi\Domain\DTO\UpdateAppServiceDto;
use Epush\Orchi\Domain\DTO\UpdateContextDto;
use Epush\Orchi\Domain\DTO\UpdateHandleGroupDto;
use Epush\Orchi\Domain\DTO\UpdateHandlerDto;

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
        $this->app->bind(AppServiceDto::class, function () {
            return new AppServiceDto(['service_id' => $this->app->make('request')->route('service_id')]);
        });

        $this->app->bind(ContextDto::class, function () {
            return new ContextDto(['context_id' => $this->app->make('request')->route('context_id')]);
        });

        $this->app->bind(HandleGroupDto::class, function () {
            return new HandleGroupDto(['handle_group_id' => $this->app->make('request')->route('handle_group_id')]);
        });

        $this->app->bind(HandlerDto::class, function () {
            return new HandlerDto(['handler_id' => $this->app->make('request')->route('handler_id')]);
        });


        $this->app->bind(UpdateAppServiceDto::class, function () {
            return new UpdateAppServiceDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateContextDto::class, function () {
            return new UpdateContextDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateHandleGroupDto::class, function () {
            return new UpdateHandleGroupDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateHandlerDto::class, function () {
            return new UpdateHandlerDto($this->app->make('request')->all());
        });
    }
}