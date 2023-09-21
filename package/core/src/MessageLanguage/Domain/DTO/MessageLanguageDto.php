<?php

namespace Epush\Core\MessageLanguage\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class MessageLanguageDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'message_language_id' => 'exists:message_languages,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getMessageLanguageID(): string
    {
        return $this->data['message_language_id']?? '';
    }
}