<?php

namespace Epush\Auth\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddRoleDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:roles,name,NULL,id,deleted_at,NULL'
        ];
    }

    public function toArray(): array
    {
        return array_intersect_key($this->data, array_flip([
            'name'
        ]));
    }
}