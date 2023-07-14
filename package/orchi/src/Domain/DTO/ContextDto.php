<?php

namespace Epush\Orchi\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class ContextDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'context_id' => 'exists:contexts,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getContextID(): string
    {
        return $this->data['context_id']?? '';
    }
}