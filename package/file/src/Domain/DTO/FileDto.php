<?php

namespace Epush\File\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class FileDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'file_id' => 'exists:files,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getFileID(): string
    {
        return $this->data['file_id']?? '';
    }
}