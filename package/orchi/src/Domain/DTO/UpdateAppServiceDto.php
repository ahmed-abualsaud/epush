<?php

namespace Epush\Orchi\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateAppServiceDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'string|max:255',
            'domain' => 'string|max:255|url',
            'ip_address' => 'ip',
            'lookup_type' => 'string|max:255',
            'lookup_endpoint' => 'string|max:255',
            'description' => 'nullable|string',
            'enabled' => 'boolean'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}