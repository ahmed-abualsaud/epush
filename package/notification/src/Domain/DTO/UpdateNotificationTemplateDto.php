<?php

namespace Epush\Notification\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateNotificationTemplateDto implements DtoContract
{
    private static string $notificationTemplateID;

    public function __construct(string $notificationTemplateID, private array $data) 
    {
        self::$notificationTemplateID = $notificationTemplateID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'string|unique:notification_templates,name,'.self::$notificationTemplateID,
            'subject' => 'string',
            'template' => 'string'        
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}