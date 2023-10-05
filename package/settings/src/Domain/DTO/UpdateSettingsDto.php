<?php

namespace Epush\Settings\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateSettingsDto implements DtoContract
{
    private static string $settingsID;

    public function __construct(string $settingsID, private array $data) 
    {
        self::$settingsID = $settingsID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'unique:settings,name,'.self::$settingsID.'|string',
            'type' => 'string',
            'value' => 'string|nullable',
            'description' => 'string|nullable',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}