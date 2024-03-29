<?php

namespace Epush\File\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddFileDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'folder_id' => 'required|exists:folders,id',
            'file' => 'mimes:jpeg,jpg,png,gif,pdf|max:8000',
            'type' => 'string|nullable'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}