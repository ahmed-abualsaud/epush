<?php

namespace Epush\SMS\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddSMSSendingHandlerDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:sms_sending_handlers',
            'phone' => 'string|nullable',
            'handler_id' => 'required|exists:handlers,id',
            'sms_template_id' => 'required|exists:sms_templates,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}