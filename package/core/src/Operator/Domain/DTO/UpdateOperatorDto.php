<?php

namespace Epush\Core\Operator\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateOperatorDto implements DtoContract
{
    private static string $operatorID;

    public function __construct(string $operatorID, private array $data) 
    {
        self::$operatorID = $operatorID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'unique:operators,name,'.self::$operatorID.'|string',
            'code' => 'unique:operators,code,'.self::$operatorID.'|string',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}