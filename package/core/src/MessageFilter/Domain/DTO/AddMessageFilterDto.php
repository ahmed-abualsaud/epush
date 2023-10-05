<?php

namespace Epush\Core\MessageFilter\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddMessageFilterDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:message_filters,name',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}