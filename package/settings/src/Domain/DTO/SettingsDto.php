<?php

namespace Epush\Settings\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class SettingsDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'settings_id' => 'exists:settings,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getSettingsID(): string
    {
        return $this->data['settings_id']?? '';
    }
}