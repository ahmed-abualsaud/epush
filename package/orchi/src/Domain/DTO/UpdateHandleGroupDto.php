<?php

namespace Epush\Orchi\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateHandleGroupDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'context_id' => 'exists:contexts,id',
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'enabled' => 'boolean'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}