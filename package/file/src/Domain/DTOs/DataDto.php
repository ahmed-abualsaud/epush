<?php

namespace Epush\File\Domain\DTOs;

use Epush\Shared\Domain\Contract\DtoContract;

class DataDto implements DtoContract
{
    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

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

    public function getColumns(): array
    {
        return $this->data['columns']?? [];
    }

    public function getRows(): array
    {
        return $this->data['rows']?? [];
    }
}
