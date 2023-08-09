<?php

namespace Epush\Core\Sales\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddSalesDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:sales',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}