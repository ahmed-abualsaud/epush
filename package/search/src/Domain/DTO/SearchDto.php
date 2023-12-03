<?php

namespace Epush\Search\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class SearchDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'take' => 'integer',
            'page' => 'integer',
            'entity' => 'required|string',
            'criteria' => 'string|nullable',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getEntity(): string
    {
        return pluralString(strtolower(decodeString($this->data['entity'])));
    }

    public function getCriteria(): string
    {
        return decodeString($this->data['criteria']);
    }

    public function getPageSize(): string
    {
        return (int) ($this->data['take'] ?? 0);
    }

    public function getPageNumber(): string
    {
        return (int) ($this->data['page'] ?? 1);
    }
}