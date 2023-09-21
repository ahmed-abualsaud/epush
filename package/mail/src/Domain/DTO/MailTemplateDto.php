<?php

namespace Epush\Mail\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class MailTemplateDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'mail_template_id' => 'exists:mail_templates,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getMailTemplateID(): string
    {
        return $this->data['mail_template_id']?? '';
    }
}