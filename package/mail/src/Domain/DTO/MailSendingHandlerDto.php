<?php

namespace Epush\Mail\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class MailSendingHandlerDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'mail_sending_handler_id' => 'exists:mail_sending_handlers,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getMailSendingHandlerID(): string
    {
        return $this->data['mail_sending_handler_id']?? '';
    }
}