<?php

namespace Epush\SMS\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateSMSTemplateDto implements DtoContract
{
    private static string $smsTemplateID;

    public function __construct(string $smsTemplateID, private array $data) 
    {
        self::$smsTemplateID = $smsTemplateID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'string|unique:sms_templates,name,'.self::$smsTemplateID,
            'subject' => 'string',
            'template' => 'string'        
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}