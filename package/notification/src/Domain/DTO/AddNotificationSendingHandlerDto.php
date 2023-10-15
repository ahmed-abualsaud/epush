<?php

namespace Epush\Notification\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddNotificationSendingHandlerDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:notification_sending_handlers',
            'user_id' => 'string|nullable',
            'handler_id' => 'required|exists:handlers,id',
            'notification_template_id' => 'required|exists:notification_templates,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}