<?php

namespace Epush\Orchi\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateHandlerDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'handle_group_id' => 'exists:handle_groups,id',
            'name' => 'string|max:255',
            'endpoint' => 'string|max:255',
            'description' => 'nullable|string',
            'enabled' => 'boolean'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}