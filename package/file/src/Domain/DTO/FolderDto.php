<?php

namespace Epush\File\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class FolderDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'folder_id' => 'exists:folders,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getFolderID(): string
    {
        return $this->data['folder_id']?? '';
    }
}