<?php

namespace Epush\SMS\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class SMSTemplateDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'sms_template_id' => 'exists:sms_templates,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getSMSTemplateID(): string
    {
        return $this->data['sms_template_id']?? '';
    }
}