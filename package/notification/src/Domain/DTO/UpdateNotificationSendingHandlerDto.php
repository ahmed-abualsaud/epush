<?php

namespace Epush\Notification\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateNotificationSendingHandlerDto implements DtoContract
{
    private static string $notificationSendingHandlerID;

    public function __construct(string $notificationSendingHandlerID, private array $data) 
    {
        self::$notificationSendingHandlerID = $notificationSendingHandlerID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'string|unique:notification_sending_handlers,name,'.self::$notificationSendingHandlerID,
            'phone' => 'string|nullable',
            'handler_id' => 'exists:handlers,id',
            'notification_template_id' => 'exists:notification_templates,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}