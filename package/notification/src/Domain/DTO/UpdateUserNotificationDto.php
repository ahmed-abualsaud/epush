<?php

namespace Epush\Notification\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateUserNotificationDto implements DtoContract
{
    private static string $userNotificationID;

    public function __construct(string $userNotificationID, private array $data) 
    {
        self::$userNotificationID = $userNotificationID;
    }

    public static function rules(): array
    {
        return [
            'user_id' => 'exists:users,id',
            'subject' => 'string',
            'content' => 'string' ,
            'read' => 'boolean',       
        ];
    }

    public function toArray(): array
    {
        ! empty($this->data['read']) && $this->data['read'] = $this->data['read'] == 'true';

        return $this->data;
    }
}