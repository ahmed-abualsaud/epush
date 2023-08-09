<?php

namespace Epush\Core\Admin\Infra\Provider;

use Epush\Core\Admin\Domain\DTO\AdminDto;
use Epush\Core\Admin\Domain\DTO\AddAdminDto;
use Epush\Core\Admin\Domain\DTO\ListAdminsDto;
use Epush\Core\Admin\Domain\DTO\SearchAdminDto;
use Epush\Core\Admin\Domain\DTO\UpdateAdminDto;

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
        $this->app->bind(AdminDto::class, function () {
            return new AdminDto(['user_id' => $this->app->make('request')->route('user_id')]);
        });

        $this->app->bind(AddAdminDto::class, function () {
            return new AddAdminDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateAdminDto::class, function () {
            return new UpdateAdminDto($this->app->make('request')->route('user_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListAdminsDto::class, function () {
            return new ListAdminsDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchAdminDto::class, function () {
            return new SearchAdminDto($this->app->make('request')->all());
        });
    }
}