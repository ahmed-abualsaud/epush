<?php

namespace Epush\SMS\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateSMSSendingHandlerDto implements DtoContract
{
    private static string $smsSendingHandlerID;

    public function __construct(string $smsSendingHandlerID, private array $data) 
    {
        self::$smsSendingHandlerID = $smsSendingHandlerID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'string|unique:sms_sending_handlers,name,'.self::$smsSendingHandlerID,
            'phone' => 'string|nullable',
            'handler_id' => 'exists:handlers,id',
            'sms_template_id' => 'exists:sms_templates,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}