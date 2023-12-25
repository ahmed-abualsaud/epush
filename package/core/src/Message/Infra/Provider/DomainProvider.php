<?php

namespace Epush\Core\Message\Infra\Provider;

use Illuminate\Support\ServiceProvider;

use Epush\Core\Message\Domain\DTO\MessageDto;
use Epush\Core\Message\Domain\DTO\AddMessageDto;
use Epush\Core\Message\Domain\DTO\SendMessageDto;
use Epush\Core\Message\Domain\DTO\ListMessagesDto;
use Epush\Core\Message\Domain\DTO\SearchMessageDto;
use Epush\Core\Message\Domain\DTO\UpdateMessageDto;
use Epush\Core\Message\Domain\DTO\BulkAddMessageDto;
use Epush\Core\Message\Domain\DTO\OldApiSendBulkDto;
use Epush\Core\Message\Domain\DTO\OldApiCheckBalanceDto;

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
        $this->app->bind(MessageDto::class, function () {
            return new MessageDto(['message_id' => $this->app->make('request')->route('message_id')]);
        });

        $this->app->bind(AddMessageDto::class, function () {
            $inputs = $this->app->make('request')->all();
            $inputs['sender_ip'] = $this->app->make('request')->ip();
            return new AddMessageDto($inputs);
        });

        $this->app->bind(BulkAddMessageDto::class, function () {
            $inputs = $this->app->make('request')->all();
            $inputs['sender_ip'] = $this->app->make('request')->ip();
            return new BulkAddMessageDto($inputs);
        });

        $this->app->bind(UpdateMessageDto::class, function () {
            return new UpdateMessageDto($this->app->make('request')->route('message_id'), $this->app->make('request')->all());
        });

        $this->app->bind(ListMessagesDto::class, function () {
            return new ListMessagesDto($this->app->make('request')->all());
        });

        $this->app->bind(SearchMessageDto::class, function () {
            return new SearchMessageDto($this->app->make('request')->all());
        });

        $this->app->bind(SendMessageDto::class, function () {
            $inputs = $this->app->make('request')->all();
            $inputs['ip_address'] = $this->app->make('request')->ip();
            return new SendMessageDto($inputs);
        });

        $this->app->bind(OldApiSendBulkDto::class, function () {
            $inputs = $this->app->make('request')->all();
            if (! array_key_exists('sender', $inputs)) {
                $inputs['sender'] = array_key_exists('from', $inputs) ? $inputs['from'] : null;
            }
            if (! array_key_exists('mobiles', $inputs)) {
                $inputs['mobiles'] = array_key_exists('to', $inputs) ? explode(",", $inputs['to']) : null;
            }
            $inputs['ip_address'] = $this->app->make('request')->ip();
            return new OldApiSendBulkDto($inputs);
        });

        $this->app->bind(OldApiCheckBalanceDto::class, function () {
            $inputs = $this->app->make('request')->all();
            $inputs['ip_address'] = $this->app->make('request')->ip();
            return new OldApiCheckBalanceDto($inputs);
        });
    }
}