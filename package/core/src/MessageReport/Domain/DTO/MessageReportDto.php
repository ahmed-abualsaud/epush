<?php

namespace Epush\Core\MessageReport\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class MessageReportDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'message_id' => 'exists:messages,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getMessageID(): string
    {
        return $this->data['message_id']?? '';
    }
}