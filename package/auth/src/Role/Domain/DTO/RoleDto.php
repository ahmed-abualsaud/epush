<?php

namespace Epush\Auth\Role\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class RoleDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'role_id' => 'exists:roles,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getRoleId(): string
    {
        return $this->data['role_id']?? '';
    }
}