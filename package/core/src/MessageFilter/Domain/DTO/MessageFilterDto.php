<?php

namespace Epush\Core\MessageFilter\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class MessageFilterDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'message_filter_id' => 'exists:message_filters,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getMessageFilterID(): string
    {
        return $this->data['message_filter_id']?? '';
    }
}