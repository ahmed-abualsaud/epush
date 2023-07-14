<?php

namespace Epush\Orchi\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateContextDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'service_id' => 'exists:app_services,id',
            'name' => 'string|max:255',
            'enabled' => 'boolean'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}