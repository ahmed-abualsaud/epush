<?php

namespace Epush\Notification\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateUserNotificationsDto implements DtoContract
{
    private static string $userID;

    public function __construct(string $userID, private array $data) 
    {
        self::$userID = $userID;
    }

    public static function rules(): array
    {
        return [
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