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
            'email' => 'string|nullable',
            'handler_id' => 'required|exists:handlers,id',
            'mail_template_id' => 'required|exists:mail_templates,id',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}