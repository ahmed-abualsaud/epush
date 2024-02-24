<?php

namespace Epush\SMS\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class ListSMSTemplatesDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'user_id' => 'integer|exists:users,id|nullable',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getUserID(): string
    {
        return (int) ($this->data['user_id'] ?? 0);
    }
}