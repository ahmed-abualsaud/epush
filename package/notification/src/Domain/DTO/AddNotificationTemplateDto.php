<?php

namespace Epush\Notification\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddNotificationTemplateDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:notification_templates',
            'subject' => 'string|nullable',
            'template' => 'required|string'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}