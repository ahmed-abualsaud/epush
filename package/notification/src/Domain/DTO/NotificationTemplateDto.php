<?php

namespace Epush\Notification\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class NotificationTemplateDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'notification_template_id' => 'exists:notification_templates,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getNotificationTemplateID(): string
    {
        return $this->data['notification_template_id']?? '';
    }
}