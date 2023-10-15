<?php

namespace Epush\Notification\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UserNotificationDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'user_notification_id' => 'exists:user_notifications,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getUserNotificationID(): string
    {
        return $this->data['user_notification_id']?? '';
    }
}