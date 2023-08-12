<?php

namespace Epush\Auth\Role\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateRoleDto implements DtoContract
{

    private static string $roleID;

    public function __construct(string $roleID, private array $data) 
    {
        self::$roleID = $roleID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'string|unique:roles,name,'.self::$roleID.',id,deleted_at,NULL',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}