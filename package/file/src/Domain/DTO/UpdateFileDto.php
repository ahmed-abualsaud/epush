<?php

namespace Epush\File\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateFileDto implements DtoContract
{
    private static string $fileID;

    public function __construct(string $fileID, private array $data) 
    {
        self::$fileID = $fileID;
    }

    public static function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'folder_id' => 'required|exists:folders,id',
            'file' => 'file|max:4096',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}