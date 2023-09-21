<?php

namespace Epush\Mail\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddMailSendingHandlerDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:mail_sending_handlers',
            'handler_id' => 'required|exists:handlers,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}