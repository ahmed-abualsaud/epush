<?php

namespace Epush\Core\Operator\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddOperatorDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:operators,name',
            'code' => 'required|string|unique:operators,code'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}