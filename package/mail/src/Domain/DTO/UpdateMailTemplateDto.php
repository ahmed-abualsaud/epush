<?php

namespace Epush\Mail\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateMailTemplateDto implements DtoContract
{
    private static string $mailTemplateID;

    public function __construct(string $mailTemplateID, private array $data) 
    {
        self::$mailTemplateID = $mailTemplateID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'string|unique:mail_templates,name,'.self::$mailTemplateID,
            'template' => 'string'        
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}