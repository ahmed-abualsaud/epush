<?php

namespace Epush\Notification\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddUserNotificationDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'user_id' => 'required|exist:users,id',
            'subject' => 'nullable|string',
            'content' => 'required|string',
            'read' => 'required|boolean',
        ];
    }

    public function toArray(): array
    {
        ! empty($this->data['read']) && $this->data['read'] = $this->data['read'] == 'true';

        return $this->data;
    }
}