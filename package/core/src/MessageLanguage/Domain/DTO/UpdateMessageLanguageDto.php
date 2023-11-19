<?php

namespace Epush\Core\MessageLanguage\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateMessageLanguageDto implements DtoContract
{
    private static string $messageLanguageID;

    public function __construct(string $messageLanguageID, private array $data) 
    {
        self::$messageLanguageID = $messageLanguageID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'string|unique:message_languages,name,'.self::$messageLanguageID,
            'max_characters_length' => 'integer',
            'split_characters_length' => 'integer',
            'characters' => 'string',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}