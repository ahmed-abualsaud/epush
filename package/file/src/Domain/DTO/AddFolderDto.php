<?php

namespace Epush\File\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddFolderDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:folders,name',
            'description' => 'string',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}