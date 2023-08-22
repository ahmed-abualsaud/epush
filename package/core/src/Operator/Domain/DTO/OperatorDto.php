<?php

namespace Epush\Core\Operator\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class OperatorDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'operator_id' => 'exists:operators,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getOperatorID(): string
    {
        return $this->data['operator_id']?? '';
    }
}