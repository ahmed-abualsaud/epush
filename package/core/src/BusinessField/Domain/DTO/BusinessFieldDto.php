<?php

namespace Epush\Core\BusinessField\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class BusinessFieldDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'business_field_id' => 'exists:business_fields,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getBusinessFieldID(): string
    {
        return $this->data['business_field_id']?? '';
    }
}