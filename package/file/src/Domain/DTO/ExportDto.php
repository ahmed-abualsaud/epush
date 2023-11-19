<?php

namespace Epush\File\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class ExportDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'columns' => 'required|array',
            'rows' => 'required|array',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
