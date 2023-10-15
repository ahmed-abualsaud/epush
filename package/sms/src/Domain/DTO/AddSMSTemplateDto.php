<?php

namespace Epush\SMS\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddSMSTemplateDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:sms_templates',
            'subject' => 'string|nullable',
            'template' => 'required|string'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}