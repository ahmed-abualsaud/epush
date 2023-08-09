<?php

namespace Epush\Core\BusinessField\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddBusinessFieldDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:business_fields',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}