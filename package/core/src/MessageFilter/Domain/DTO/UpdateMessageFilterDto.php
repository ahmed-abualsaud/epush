<?php

namespace Epush\Core\MessageFilter\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateMessageFilterDto implements DtoContract
{
    private static string $messageFilterID;

    public function __construct(string $messageFilterID, private array $data) 
    {
        self::$messageFilterID = $messageFilterID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'unique:message_filters,name,'.self::$messageFilterID.'|string',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}