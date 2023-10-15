<?php

namespace Epush\Mail\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddMailTemplateDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:mail_templates',
            'subject' => 'required|string',
            'template' => 'required|string'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}