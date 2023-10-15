<?php

namespace Epush\Notification\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class NotificationSendingHandlerDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'notification_sending_handler_id' => 'exists:notification_sending_handlers,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getNotificationSendingHandlerID(): string
    {
        return $this->data['notification_sending_handler_id']?? '';
    }
}