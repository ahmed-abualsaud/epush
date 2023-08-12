<?php

namespace Epush\Auth\Role\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AssignRolePermissionsDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [];
    }

    public function toArray(): array
    {
        return $this->data['permissions_id'] ?? [];
    }
}