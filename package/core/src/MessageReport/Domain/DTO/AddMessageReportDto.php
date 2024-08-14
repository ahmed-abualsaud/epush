<?php

namespace Epush\Core\MessageReport\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddMessageReportDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'valid' => 'required|numeric',
            'unknown' => 'required|numeric',
            'inactive' => 'required|numeric',
            'doublication' => 'required|numeric',
            'operators' => 'required|array'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}