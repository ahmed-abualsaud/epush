<?php

namespace Epush\Core\MessageLanguage\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddMessageLanguageDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:message_languages,name',
            'max_characters_length' => 'required|integer',
            'split_characters_length' => 'integer',
            'characters' => 'required|string',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}