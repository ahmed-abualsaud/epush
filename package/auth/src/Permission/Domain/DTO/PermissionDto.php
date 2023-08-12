<?php

namespace Epush\Auth\Permission\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class PermissionDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'permission_id' => 'exists:permissions,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getPermissionId(): string
    {
        return $this->data['permission_id']?? '';
    }
}