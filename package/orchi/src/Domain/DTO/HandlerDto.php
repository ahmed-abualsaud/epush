<?php

namespace Epush\Orchi\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class HandlerDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'handler_id' => 'exists:handlers,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getHandlerID(): string
    {
        return $this->data['handler_id']?? '';
    }
}