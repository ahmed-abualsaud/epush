<?php

namespace Epush\Settings\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddSettingsDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:settings,name',
            'type' => 'required|string',
            'value' => 'required|string|nullable',
            'description' => 'string|nullable',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}