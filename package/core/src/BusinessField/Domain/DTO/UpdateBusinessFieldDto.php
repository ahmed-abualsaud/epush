<?php

namespace Epush\Core\BusinessField\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateBusinessFieldDto implements DtoContract
{
    private static string $businessFieldID;

    public function __construct(string $businessFieldID, private array $data) 
    {
        self::$businessFieldID = $businessFieldID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'string|unique:business_fields,name,'.self::$businessFieldID,
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}