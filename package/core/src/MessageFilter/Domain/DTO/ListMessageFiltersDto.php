<?php

namespace Epush\Core\MessageFilter\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class ListMessageFiltersDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'take' => 'integer',
            'page' => 'integer'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getPageSize(): string
    {
        return (int) ($this->data['take'] ?? 0);
    }
}