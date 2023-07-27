<?php

namespace Epush\Auth\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UnassignUserPermissionsDto implements DtoContract
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