<?php

namespace Epush\Auth\Permission\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdatePermissionDto implements DtoContract
{

    private static string $permissionID;

    public function __construct(string $permissionID, private array $data)
    {
        self::$permissionID = $permissionID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'string|unique:permissions,name,'.self::$permissionID.',id,deleted_at,NULL',
            'description' => 'string',
            'handler_id' => 'exists:handlers,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}