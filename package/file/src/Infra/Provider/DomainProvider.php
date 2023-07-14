<?php

namespace Epush\File\Infra\Provider;

use Epush\File\Domain\DTO\DataDto;
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
        $this->app->bind(DataDto::class, function () {
            $data = $this->app->make('request')->all();

            if (array_key_exists('columns', $data) && gettype($data['columns']) === 'string') {
                $data['columns'] = json_decode($data['columns'], true);
            }
            if (array_key_exists('rows', $data) && gettype($data['rows']) === 'string') {
                $data['rows'] = json_decode($data['rows'], true);
            }

            return new DataDto($data);
        });
    }
}