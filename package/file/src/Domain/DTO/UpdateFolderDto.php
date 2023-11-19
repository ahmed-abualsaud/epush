<?php

namespace Epush\File\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateFolderDto implements DtoContract
{
    private static string $folderID;

    public function __construct(string $folderID, private array $data) 
    {
        self::$folderID = $folderID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'unique:folders,name,'.self::$folderID.'|string',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}